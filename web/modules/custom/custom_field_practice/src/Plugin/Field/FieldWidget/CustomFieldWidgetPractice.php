<?php

namespace Drupal\custom_field_practice\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'snippets_default' widget.
 *
 * @FieldWidget(
 *   id = "custom_field_practice_widget",
 *   label = @Translation("Custom Field Widget"),
 *   field_types = {
 *     "custom_field_practice_type"
 *   }
 * )
 */
class CustomFieldWidgetPractice extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $element['source_description'] = [
      '#title' => $this->t('Description'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->source_description) ? $items[$delta]->source_description : NULL,
    ];
    $element['source_code'] = [
      '#title' => $this->t('Code'),
      '#type' => 'textarea',
      '#default_value' => isset($items[$delta]->source_code) ? $items[$delta]->source_code : NULL,
    ];
    $element['source_lang'] = [
      '#title' => $this->t('Source language'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->source_lang) ? $items[$delta]->source_lang : NULL,
    ];
    return $element;
  }

}