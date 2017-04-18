<?php

namespace Drupal\jsonapi_config\Plugin\Type;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages discovery and instantiation of JSON API resource plugins.
 */
class JsonapiResourcePluginManager extends DefaultPluginManager {

  /**
   * Constructs a new \Drupal\jsonapi_config\Plugin\Type\ResourcePluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/jsonapi/resource', $namespaces, $module_handler, 'Drupal\jsonapi_config\Plugin\JsonapiResourceInterface', 'Drupal\jsonapi_config\Annotation\JsonapiResource');
    $this->setCacheBackend($cache_backend, 'jsonapi_plugins');
  }
}
