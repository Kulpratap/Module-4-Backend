<?php

namespace Drupal\custom_field_task\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'color_picker_widget' widget.
 *
 * @FieldWidget(
 *   id = "color_picker_widget",
 *   label = @Translation("Color Picker Widget"),
 *   field_types = {
 *     "custom_field_task"
 *   }
 * )
 */
class ColorPickerWidget extends WidgetBase {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = $items[$delta]->getValue();
    $element['color_picker'] = [
      '#type' => 'color',
      '#title' => $this->t('Pick a color'),
      '#default_value' => sprintf('#%02x%02x%02x', $value['red'] ?? 0, $value['green'] ?? 0, $value['blue'] ?? 0),
    ];
    return $element;
  }

  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $hex = ltrim($values[0]['color_picker'], '#');
    return [
      'red' => hexdec(substr($hex, 0, 2)),
      'green' => hexdec(substr($hex, 2, 2)),
      'blue' => hexdec(substr($hex, 4, 2)),
    ];
  }
}
