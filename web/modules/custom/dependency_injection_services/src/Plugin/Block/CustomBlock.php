<?php
/**
 * @file
 * Contains \Drupal\customblock\Plugin\Block\ArticleBlock.
 */

namespace Drupal\dependency_injection_services\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *   id = "dependency_injection_services",
 *   admin_label = @Translation("Services and dependency injection"),
 *   category = @Translation("Custom Custom block example")
 * )
 */
class CustomBlock extends BlockBase {

  protected $loaddata;

  public function __construct(){
    $this->loaddata = \Drupal::service('dependency_injection_services.dbinsert'); 
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $data = $this->loaddata->getData();
    return [
      '#theme' => 'my_template',
      '#data' => $data,
    ];
   }
}