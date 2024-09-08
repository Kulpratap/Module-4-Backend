<?php

namespace Drupal\custom_field_task\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_color_widget' widget.
 *
 * @FieldWidget(
 *   id = "rgb_color_widget",
 *   label = @Translation("RGB Color Widget"),
 *   field_types = {
 *     "custom_field_task"
 *   }
 * )
 */
class RgbColorWidget extends WidgetBase {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->getValue();
    $element['red'] = [
      '#type' => 'number',
      '#title' => $this->t('Red'),
      '#default_value' => $value['red'] ?? 0,
      '#min' => 0,
      '#max' => 255,
    ];
    $element['green'] = [
      '#type' => 'number',
      '#title' => $this->t('Green'),
      '#default_value' => $value['green'] ?? 0,
      '#min' => 0,
      '#max' => 255,
    ];
    $element['blue'] = [
      '#type' => 'number',
      '#title' => $this->t('Blue'),
      '#default_value' => $value['blue'] ?? 0,
      '#min' => 0,
      '#max' => 255,
    ];
    return $element;
  }

  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    return $values[0];
  }
}
