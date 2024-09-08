<?php

namespace Drupal\custom_field_task\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'rgb_color_background_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_color_background_formatter",
 *   label = @Translation("Color Background"),
 *   field_types = {
 *     "custom_field_task"
 *   }
 * )
 */
class RgbColorBackgroundFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $color_code = sprintf('#%02x%02x%02x', $item->red, $item->green, $item->blue);
      $elements[$delta] = [
        '#type' => 'inline_template',
        '#template' => '<div style="background-color: {{ color }}; padding: 10px;">{{ color }}</div>',
        '#context' => ['color' => $color_code],
      ];
    }

    return $elements;
  }
}
