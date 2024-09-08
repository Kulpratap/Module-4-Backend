<?php

namespace Drupal\event_dashboard\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;

/**
 * Provides an 'Event Dashboard' block.
 *
 * @Block(
 *   id = "event_dashboard_block",
 *   admin_label = @Translation("Event Dashboard"),
 * )
 */
class EventDashboardBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $connection = Database::getConnection();

    $yearly_counts = $connection->query("
      SELECT COUNT(entity_id) as count, YEAR(field_event_date_value) as year
      FROM {node__field_event_date}
      GROUP BY year
      ORDER BY year DESC
    ")->fetchAllKeyed();

    $quarterly_counts = $connection->query("
      SELECT COUNT(entity_id) as count, QUARTER(field_event_date_value) as quarter
      FROM {node__field_event_date}
      GROUP BY quarter
      ORDER BY quarter
    ")->fetchAllKeyed();

    $type_counts = $connection->query("
      SELECT fet.field_event_type_value as type, COUNT(nfd.nid) as count
      FROM {node_field_data} nfd
      JOIN {node__field_event_type} fet ON nfd.nid = fet.entity_id
      WHERE nfd.type = 'event'
      GROUP BY fet.field_event_type_value
      ORDER BY count DESC
    ")->fetchAllKeyed();

    return [
      '#theme' => 'event_dashboard',
      '#yearly_counts' => $yearly_counts,
      '#quarterly_counts' => $quarterly_counts,
      '#type_counts' => $type_counts,
    ];
  }
}
