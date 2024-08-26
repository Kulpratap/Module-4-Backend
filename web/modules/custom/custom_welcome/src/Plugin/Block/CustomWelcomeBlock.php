<?php

namespace Drupal\custom_welcome\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'Custom Welcome' block.
 *
 * @Block(
 *   id = "custom_welcome_block",
 *   admin_label = @Translation("Custom Welcome Block"),
 *   category = @Translation("Custom")
 *   
 * )
 */
class CustomWelcomeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a Drupalist object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Session\AccountInterface $currentUser
   *   The current_user.
   */
  public function __construct(
    array $configuration, 
    $plugin_id, 
    $plugin_definition, 
    protected AccountInterface $currentUser,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }
  
   /**
   * {@inheritdoc}
   */
  public function build() {
    $roles = $this->currentUser->getRoles();
    $role_string = implode(', ', $roles);

    return [
      '#markup' => $this->t('Welcome @role', ['@role' => $role_string]),
    ];
  }
}
