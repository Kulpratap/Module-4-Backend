<?php 

namespace Drupal\entity_task\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MovieNodeSubscriber implements EventSubscriberInterface {

  protected $configFactory;

  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['checkMovieBudget'];
    return $events;
  }

  public function checkMovieBudget(RequestEvent $event) {
    $request = $event->getRequest();
    $node = $request->attributes->get('node');

    if ($node instanceof NodeInterface && $node->bundle() == 'moviess') {
      $config = $this->configFactory->get('entity_task.settings');
      $budget_amount = floatval($config->get('budget_amount'));
      $movie_price = floatval($node->get('movie_price')->value);

      \Drupal::messenger()->deleteAll();

      if ($movie_price > $budget_amount) {
        \Drupal::messenger()->addMessage(t('The movie is over budget'), 'warning');
      }
      elseif ($movie_price < $budget_amount) {
        \Drupal::messenger()->addMessage(t('The movie is under budget'), 'status');
      }
      else {
        \Drupal::messenger()->addMessage(t('The movie is within budget'), 'status');
      }
    }
  }
}
