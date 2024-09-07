<?php

declare(strict_types=1);

namespace Drupal\entity_task\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Movie type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "movie_type",
 *   label = @Translation("Movie type"),
 *   label_collection = @Translation("Movie types"),
 *   label_singular = @Translation("movie type"),
 *   label_plural = @Translation("movies types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count movies type",
 *     plural = "@count movies types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\entity_task\Form\MovieTypeForm",
 *       "edit" = "Drupal\entity_task\Form\MovieTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\entity_task\MovieTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer movie types",
 *   bundle_of = "movie",
 *   config_prefix = "movie_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/movie_types/add",
 *     "edit-form" = "/admin/structure/movie_types/manage/{movie_type}",
 *     "delete-form" = "/admin/structure/movie_types/manage/{movie_type}/delete",
 *     "collection" = "/admin/structure/movie_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class MovieType extends ConfigEntityBundleBase {

  /**
   * The machine name of this movie type.
   */
  protected string $id;

  /**
   * The human-readable name of the movie type.
   */
  protected string $label;

}
