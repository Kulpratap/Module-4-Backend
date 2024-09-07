<?php

declare(strict_types=1);

namespace Drupal\entity_task;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of movie configs.
 */
final class MovieConfigListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Movie Title');
    $header['year'] = $this->t('Year');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\entity_task\MovieConfigInterface $entity */
    $row['id'] = $entity->id();
    $row['title'] = $entity->label();
    $row['year'] = $entity->get('year');
    return $row + parent::buildRow($entity);
  }

}
