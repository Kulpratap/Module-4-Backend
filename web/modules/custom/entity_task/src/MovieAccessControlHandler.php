<?php

declare(strict_types=1);

namespace Drupal\entity_task;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the movie entity type.
 *
 * phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
 *
 * @see https://www.drupal.org/project/coder/issues/3185082
 */
final class MovieAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account): AccessResult {
    if ($account->hasPermission($this->entityType->getAdminPermission())) {
      return AccessResult::allowed()->cachePerPermissions();
    }

    return match($operation) {
      'view' => AccessResult::allowedIfHasPermission($account, 'view movie'),
      'update' => AccessResult::allowedIfHasPermission($account, 'edit movie'),
      'delete' => AccessResult::allowedIfHasPermission($account, 'delete movie'),
      'delete revision' => AccessResult::allowedIfHasPermission($account, 'delete movie revision'),
      'view all revisions', 'view revision' => AccessResult::allowedIfHasPermissions($account, ['view movie revision', 'view movie']),
      'revert' => AccessResult::allowedIfHasPermissions($account, ['revert movie revision', 'edit movie']),
      default => AccessResult::neutral(),
    };
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL): AccessResult {
    return AccessResult::allowedIfHasPermissions($account, ['create movie', 'administer movie types'], 'OR');
  }

}
