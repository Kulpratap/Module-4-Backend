<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Controller for the custom page.
 */
class CustomPageController extends ControllerBase {

  /**
   * Custom page callback.
   */
  public function customPage() {
    return [
      '#markup' => 'Hello, this is a custom page!',
    ];
  }

  /**
   * Access check for the custom page.
   */
  public function access(AccountInterface $account) {
    if ($account->hasPermission('access custom page')) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }
}
