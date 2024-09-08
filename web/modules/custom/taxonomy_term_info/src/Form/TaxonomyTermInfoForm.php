<?php

namespace Drupal\taxonomy_term_info\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @file This file contains the TaxonomyTermInfoForm
 */

/**
 * Summary of TaxonomyTermInfoForm.
 */
class TaxonomyTermInfoForm extends FormBase {
  /**
   * The entity type manager service.
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;
  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs a new TaxonomyTermInfoForm.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, MessengerInterface $messenger) {
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'taxonomy_term_info_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['term_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter the taxonomy term name'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $term_name = $form_state->getValue('term_name');

    $term_storage = $this->entityTypeManager->getStorage('taxonomy_term');
    $term = $term_storage->loadByProperties(['name' => $term_name]);

    if (!empty($term)) {
      $term = reset($term);
      $term_id = $term->id();
      $term_uuid = $term->uuid();
      $this->messenger->addStatus($this->t('Term ID: @id', ['@id' => $term_id]));
      $this->messenger->addStatus($this->t('Term UUID: @uuid', ['@uuid' => $term_uuid]));

      $query = $this->entityTypeManager->getStorage('node')->getQuery()
        ->condition('status', 1)
        ->condition('field_tags', $term_id)
        ->accessCheck(FALSE);

      $nids = $query->execute();

      if (!empty($nids)) {
        $nodes = Node::loadMultiple($nids);

        foreach ($nodes as $node) {
          $node_title = $node->getTitle();
          $node_url = $node->toUrl()->toString();
          $this->messenger->addStatus($this->t('Node Title: @title, Node URL: @url', [
            '@title' => $node_title,
            '@url' => $node_url,
          ]));
        }
      }
      else {
        $this->messenger->addStatus($this->t('No nodes found with this term.'));
      }
    }
    else {
      $this->messenger->addError($this->t('Taxonomy term not found.'));
    }
  }

}
