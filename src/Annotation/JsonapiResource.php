<?php

namespace Drupal\jsonapi_config\Annotation;

use \Drupal\Component\Annotation\Plugin;

/**
 * Defines a JSON API resource annotation object.
 *
 * Plugin Namespace: Plugin\jsonapi\resource
 *
 * @Annotation
 */
class JsonapiResource extends Plugin {

  /**
   * The resource plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the resource plugin.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $label;

  /**
   * The entity type.
   *
   * @var string
   */
  public $entity_type;

  /**
   * The entity bundle.
   *
   * @var string
   */
  public $bundle;

}
