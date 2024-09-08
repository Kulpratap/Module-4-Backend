<?php
namespace Drupal\custom_movie\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MovieBudgetForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_movie.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'movie_budget_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_movie.settings');

    $form['budget_friendly_amount'] = [
      '#type' => 'number',
      '#title' => $this->t('Budget-friendly Amount'),
      '#description' => $this->t('Set the amount to define a budget-friendly movie.'),
      '#default_value' => $config->get('budget_friendly_amount'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_movie.settings')
      ->set('budget_friendly_amount', $form_state->getValue('budget_friendly_amount'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
