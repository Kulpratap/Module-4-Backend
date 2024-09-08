<?php

/**
 * @file Contains "CustomFieldTypeTask" class for creating custom field type
 *
 */

namespace Drupal\custom_field_task\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldDefinitionInterface;

/**
 * Plugin implementation of the Custom Task field type.
 *
 * @FieldType(
 *   id = "custom_field_task",
 *   label = @Translation("Custom field Task"),
 *   description = @Translation("This field accept RGB color"),
 *   default_widget = "custom_field_task_widget",
 *   default_formatter = "rgb_color_code_formatter"
 * )
 */


class CustomFieldTypeTask extends FieldItemBase {

  /**
   * {@inheritDoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_deination)
  {
    return [
      'columns' => [
        'red' => [
          'type' => 'int',
          'size' => 'tiny',
          'unsigned' => TRUE,
        ],
        'green' => [
          'type' => 'int',
          'size' => 'tiny',
          'unsigned' => TRUE,
        ],
        'blue' => [
          'type' => 'int',
          'size' => 'tiny',
          'unsigned' => TRUE,
        ],
      ],
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('red')->getValue();
    return $value === NULL || $value === '';
  }
  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function preSave() {
    parent::preSave();
  }
  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['red'] = DataDefinition::create('integer')
      ->setLabel(t('Red'))
      ->setRequired(TRUE);

    $properties['blue'] = DataDefinition::create('integer')
      ->setLabel(t('Blue'))
      ->setRequired(TRUE);

    $properties['green'] = DataDefinition::create('integer')
      ->setLabel(t('Green'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritDoc}
   * 
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $values = [
      'red' => mt_rand(0, 255),
      'green' => mt_rand(0, 255),
      'blue' => mt_rand(0, 255),
    ];
    return $values;
  }
}
