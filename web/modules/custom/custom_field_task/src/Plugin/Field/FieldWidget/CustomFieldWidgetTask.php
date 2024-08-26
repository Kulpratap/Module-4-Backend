<?php

/**
 * @file contains Plugin implementation of the CustomFieldWidgetTask class.
 * 
 */

namespace Drupal\custom_field_task\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the Custom Field Task widget.
 *
 * @FieldWidget(
 *   id = "custom_field_task_widget",
 *   label = @Translation("Custom Field Task Widget"),
 *   field_types = {
 *     "custom_field_task"
 *   }
 * )
 */

class CustomFieldWidgetTask extends WidgetBase{
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->getValue();
    $element['hex_color'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hex Color'),
      '#default_value' => sprintf('#%02x%02x%02x', $value['red'] ?? 0, $value['green'] ?? 0, $value['blue'] ?? 0),
      '#size' => 7,
      '#maxlength' => 7,
    ];
    return $element;
  }

  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $hex = ltrim($values[0]['hex_color'], '#');
    return [
      'red' => hexdec(substr($hex, 0, 2)),
      'green' => hexdec(substr($hex, 2, 2)),
      'blue' => hexdec(substr($hex, 4, 2)),
    ];
  }
}