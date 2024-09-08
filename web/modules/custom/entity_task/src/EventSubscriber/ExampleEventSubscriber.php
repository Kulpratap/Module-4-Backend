<?php

namespace Drupal\entity_task\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExampleEventSubscriber implements EventSubscriberInterface{

  public static function getSubscribedEvents(){
    $events[ConfigEvents::SAVE][] = ['onSavingConfig', 800];
    return $events;
  }

  public function onSavingConfig(ConfigCrudEvent $event){
    \Drupal::messenger()->addStatus("You have saved a configuration of ". $event->getConfig()->getName());
  }
}