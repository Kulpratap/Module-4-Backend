<?php
namespace Drupal\custom_service\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the custom welcome page.
 */
class CustomServiceController extends ControllerBase {

  /**
   * Returns the content for the custom welcome page.
   */
  public function message() {
    $service = \Drupal::service('custom_service.utilityservice');

    $message = $service->printmessage();
    $id = $service->printId();
    $build = [
      'content' => [
        '#markup' => $message."(".$id.")"
      ],
    ];
    return $build;
  }

}
