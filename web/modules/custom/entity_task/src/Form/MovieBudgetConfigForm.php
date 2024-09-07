<?php

namespace Drupal\entity_task\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for setting the movie budget.
 */
class MovieBudgetConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   * Get the editable config names.
   */
  protected function getEditableConfigNames() {
    return ['entity_task.settings'];
  }

  /**
   * {@inheritdoc}
   * Get form id from the function.
   */
  public function getFormId() {
    return 'movie_budget_config_form';
  }

  /**
   * {@inheritdoc}
   * Build 
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('entity_task.settings');

    $form['budget_amount'] = [
      '#type' => 'number',
      '#title' => $this->t('Budget Amount'),
      '#description' => $this->t('Enter the budget-friendly amount for movies.'),
      '#default_value' => $config->get('budget_amount'),
      '#step' => 0.01,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('entity_task.settings')
      ->set('budget_amount', $form_state->getValue('budget_amount'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
