<?php

declare(strict_types=1);

namespace Drupal\entity_task;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of movies configs.
 */
final class MoviesConfigListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['label'] = $this->t('Label');
    $header['id'] = $this->t('Machine name');
    $header['title'] = $this->t('Movie Title');
    $header['year'] = $this->t('Year');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\entity_task\MoviesConfigInterface $entity */
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['title'] = $entity->get('title');
    $row['year'] = $entity->get('year');
    return $row + parent::buildRow($entity);
  }

}
