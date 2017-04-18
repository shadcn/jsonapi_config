<?php

namespace Drupal\jsonapi_config\ResourceType;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ResourceTypeRepository extends \Drupal\jsonapi\ResourceType\ResourceTypeRepository {

  /**
   * The plugin manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $pluginManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, EntityTypeBundleInfoInterface $bundle_manager, PluginManagerInterface $plugin_manager) {
    parent::__construct($entity_type_manager, $bundle_manager);
    $this->pluginManager = $plugin_manager;
  }


  /**
   * {@inheritdoc}
   */
  public function all() {
    $resources = parent::all();

    // Filter out disabled resources.
    /** @var \Drupal\jsonapi\ResourceType\ResourceType $resource */
    $enabled_resources = $this->getEnabledResources();
    foreach ($resources as $key => $resource) {
      $entity_type_id = $resource->getEntityTypeId();
      if (!(isset($enabled_resources[$entity_type_id]) && in_array($resource->getBundle(), $enabled_resources[$entity_type_id]))) {
        unset($resources[$key]);
      }
    }

    $this->all = $resources;

    return $resources;
  }

  /**
   * {@inheritdoc}
   */
  public function get($entity_type_id, $bundle) {
    if ($resource = parent::get($entity_type_id, $bundle)) {
      return $resource;
    }

    throw new UnprocessableEntityHttpException(sprintf('Resource "%s--%s" was not found.', $entity_type_id, $bundle));
  }

  /**
   * Returns an array of enabled resources bunddles keyed by entity_type_ids.
   *
   * @return array
   */
  protected function getEnabledResources() {
    $resources = [];

    // Get JsonapiResource plugins.
    $definitions = $this->pluginManager->getDefinitions();
    foreach ($definitions as $definition) {
      $resources[$definition['entity_type']][] = $definition['bundle'];
    }

    return $resources;
  }
}
