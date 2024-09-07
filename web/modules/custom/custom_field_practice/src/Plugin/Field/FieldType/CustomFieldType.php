<?php
 
namespace Drupal\custom_field_practice\Plugin\Field\FieldType;


use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'snippets' field type.
 *
 * @FieldType(
 *   id = "custom_field_practice_type",
 *   label = @Translation("Custom field Practice"),
 *   description = @Translation("This field for practice and store code snippets in the database."),
 *   default_widget = "custom_field_practice_widget",
 *   default_formatter = "custom_field_practice_formatter"
 * )
 */
class CustomFieldType extends FieldItemBase {

  /**
   * {@inheritDoc}
   */

   public static function schema(FieldStorageDefinitionInterface $field) {
    return [
      'columns' => [
        'source_description' => [
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ],
        'source_code' => [
          'type' => 'text',
          'size' => 'big',
          'not null' => FALSE,
        ],
        'source_lang' => [
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
 * {@inheritdoc}
 */
  public function isEmpty() {
    $value = $this->get('source_code')->getValue();
    return $value === NULL || $value === '';
  } 
  /**
 * {@inheritdoc}
 */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['source_description'] = DataDefinition::create('string')
      ->setLabel(t('Snippet description'));

    $properties['source_code'] = DataDefinition::create('string')
      ->setLabel(t('Snippet code'));

    $properties['source_lang'] = DataDefinition::create('string')
      ->setLabel(t('Programming Language'))
      ->setDescription(t('Snippet code language'));

    return $properties;
  }
}