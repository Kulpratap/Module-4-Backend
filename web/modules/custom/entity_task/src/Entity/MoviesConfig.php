<?php

declare(strict_types=1);

namespace Drupal\entity_task\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\entity_task\MoviesConfigInterface;

/**
 * Defines the movies config entity type.
 *
 * @ConfigEntityType(
 *   id = "movies_config",
 *   label = @Translation("Movies COnfig"),
 *   label_collection = @Translation("Movies COnfigs"),
 *   label_singular = @Translation("movies config"),
 *   label_plural = @Translation("movies configs"),
 *   label_count = @PluralTranslation(
 *     singular = "@count movies config",
 *     plural = "@count movies configs",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\entity_task\MoviesConfigListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entity_task\Form\MoviesConfigForm",
 *       "edit" = "Drupal\entity_task\Form\MoviesConfigForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   config_prefix = "movies_config",
 *   admin_permission = "administer movies_config",
 *   links = {
 *     "collection" = "/admin/structure/movies-config",
 *     "add-form" = "/admin/structure/movies-config/add",
 *     "edit-form" = "/admin/structure/movies-config/{movies_config}",
 *     "delete-form" = "/admin/structure/movies-config/{movies_config}/delete",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "year",
 *     "title"
 *   },
 * )
 */
final class MoviesConfig extends ConfigEntityBase implements MoviesConfigInterface {

  /**
   * The example ID.
   */
  protected string $id;

  /**
   * The example label.
   */
  protected string $label;

  /**
   * The example description.
   */
  protected string $description;

  /**
   * The movie title.
   *
   * @var string
   */
  protected $title;

  /**
   * The year the movie won the award.
   *
   * @var string
   */
  protected $year;

}
