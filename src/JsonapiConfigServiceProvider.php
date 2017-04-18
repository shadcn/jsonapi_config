<?php

namespace Drupal\jsonapi_config;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

class JsonapiConfigServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    // Swap the class for the jsonapi.resource_type.repository service.
    if ($container->has('jsonapi.resource_type.repository')) {
      $container->getDefinition('jsonapi.resource_type.repository')
        ->setClass('\Drupal\jsonapi_config\ResourceType\ResourceTypeRepository')
        ->addArgument(new Reference('plugin.manager.jsonapi_config'));
    }
  }

}
