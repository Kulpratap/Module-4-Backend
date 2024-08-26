<?php

namespace Drupal\custom_field_practice\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'snippets_default' formatter.
 *
 * @FieldFormatter(
 *   id = "custom_field_practice_formatter",
 *   label = @Translation("Custom Field Formatter"),
 *   field_types = {
 *     "custom_field_practice_type"
 *   }
 * )
 */
class CustomFieldPracticeFormatter extends FormatterBase
{
   
  /**
   * {@inheritdoc}
   */

  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => $item->source_description."\n".$item->source_code." ".$item->source_lang,
      ];
    }
    return $element;
  }
}