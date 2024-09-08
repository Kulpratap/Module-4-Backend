<?php

namespace Drupal\node_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\File\FileUrlGeneratorInterface;

/**
 * Class NodeApiController.
 *
 * @package Drupal\node_api\Controller
 */
class NodeApiController extends ControllerBase {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The file URL generator service.
   *
   * @var \Drupal\Core\File\FileUrlGeneratorInterface
   */
  protected $fileUrlGenerator;

  /**
   * Constructs a NodeApiController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   * @param \Drupal\Core\File\FileUrlGeneratorInterface $fileUrlGenerator
   *   The file URL generator service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, FileUrlGeneratorInterface $fileUrlGenerator) {
    $this->entityTypeManager = $entityTypeManager;
    $this->fileUrlGenerator = $fileUrlGenerator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('file_url_generator')
    );
  }

  /**
   * List nodes of a specific content type.
   *
   * @param string $content_type
   *   The machine name of the content type.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing the node data.
   */
  public function listNodes($content_type) {
    $node_storage = $this->entityTypeManager->getStorage('node');
    $query = $node_storage->getQuery()
      ->condition('type', $content_type)
      ->condition('status', 1)
      ->accessCheck(TRUE);

    $nids = $query->execute();
    $nodes = $node_storage->loadMultiple($nids);

    $node_data = [];
    foreach ($nodes as $node) {
  
      if ($node->hasField('body')) {
        $body=$node->get('body')->value;
      }
      $data = [
        'nid' => $node->id(),
        'title' => $node->getTitle(),
        'created' => $node->getCreatedTime(), 
        'body' => $body
      ];
      
      if ($node->hasField('field_image') && !$node->get('field_image')->isEmpty()) {
        $image_field = $node->get('field_image')->entity; 
        if ($image_field) {
          $data['field_image'] = [
            'url' => $this->fileUrlGenerator->generateAbsoluteString($image_field->getFileUri()),
            'alt' => $node->get('field_image')->alt,
            'title' => $node->get('field_image')->title,
          ];
        }
      }

      $node_data[] = $data;
    }

    return new JsonResponse($node_data);
  }
}
