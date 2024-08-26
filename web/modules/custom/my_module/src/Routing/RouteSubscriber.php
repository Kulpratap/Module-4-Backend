<?php

namespace Drupal\my_module\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Check if the route exists.
    if ($route = $collection->get('my_module.custom_page')) {
      // Get the current permission requirements.
      $requirements = $route->getRequirement('_permission');

      if ($requirements) {
        // Remove specific roles or permissions (e.g., 'content editor').
        $permissions = explode(' ', $requirements);
        // Example: Remove the permission or role.
        $permissions = array_diff($permissions, ['content editor']);
        $route->setRequirement('_permission', implode(' ', $permissions));
      }
    }
  }
}
