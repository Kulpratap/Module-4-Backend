<?php

declare(strict_types=1);

namespace Drupal\entity_task\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\entity_task\MovieConfigInterface;

/**
 * Defines the movie config entity type.
 *
 * @ConfigEntityType(
 *   id = "movie_config",
 *   label = @Translation("Movie Config"),
 *   label_collection = @Translation("Movie Configs"),
 *   label_singular = @Translation("movie config"),
 *   label_plural = @Translation("movie configs"),
 *   label_count = @PluralTranslation(
 *     singular = "@count movie config",
 *     plural = "@count movie configs",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\entity_task\MovieConfigListBuilder",
 *     "form" = {
 *       "add" = "Drupal\entity_task\Form\MovieConfigForm",
 *       "edit" = "Drupal\entity_task\Form\MovieConfigForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   config_prefix = "movie_config",
 *   admin_permission = "administer movie_config",
 *   links = {
 *     "collection" = "/admin/structure/movie-config",
 *     "add-form" = "/admin/structure/movie-config/add",
 *     "edit-form" = "/admin/structure/movie-config/{movie_config}",
 *     "delete-form" = "/admin/structure/movie-config/{movie_config}/delete",
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
final class MovieConfig extends ConfigEntityBase implements MovieConfigInterface {

  /**
   * The example ID.
   */
  protected string $id;

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
