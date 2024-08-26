<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller for the campaign value page.
 */
class CampaignValueController extends ControllerBase {

  /**
   * Fetch the value from the route.
   */
  public function value($value) {
    return new Response('The value is: ' . $value);
  }
}
