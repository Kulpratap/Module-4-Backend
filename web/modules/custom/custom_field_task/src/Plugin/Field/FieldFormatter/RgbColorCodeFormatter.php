<?php

namespace Drupal\custom_field_task\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'rgb_color_code_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_color_code_formatter",
 *   label = @Translation("Color Code"),
 *   field_types = {
 *     "custom_field_task"
 *   }
 * )
 */
class RgbColorCodeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    
    foreach ($items as $delta => $item) {
      $color_code = sprintf('#%02x%02x%02x', $item->red, $item->green, $item->blue);
      $elements[$delta] = [
        '#markup' => $this->t('Color code: @code', ['@code' => $color_code]),
      ];
    }

    return $elements;
  }
}
