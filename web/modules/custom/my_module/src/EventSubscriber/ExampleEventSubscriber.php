<?php

/**
 * @file 
 * Contains \Drupal\my_module\ExampleEventSubscriber
 */

namespace Drupal\my_module\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ExampleEventSubscriber 
 *@package my_module
 */
class ExampleEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritDoc}
   */

  public static function getSubscribedEvents(){
    $events[ConfigEvents::SAVE][]=array('onSavingConfig',800);
    return $events;
  }

  /**
   * Subscriber Callback for the event
   * @param ConfigCrudEvent $event
   * 
   */
  public function onSavingConfig(ConfigCrudEvent $event){
    \Drupal::messenger()->addStatus("You have saved a configutation of ". $event->getConfig()->getName());
  }

}