<?php

namespace Drupal\phone_formatter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Phone Number Form.
 */
class PhoneNumberForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'phone_number_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['phone_number'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#attributes' => [
        'class' => ['phone-number'],
        'placeholder' => $this->t('(xxx) xxx-xxxx'),
      ],
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    $form['#attached']['library'][] = 'phone_formatter/phone_formatter';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display the formatted phone number.
    $phone_number = $form_state->getValue('phone_number');
    \Drupal::messenger()->addMessage($this->t('You have submitted the phone number: @phone_number', ['@phone_number' => $phone_number]));
  }

}
