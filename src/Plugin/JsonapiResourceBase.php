<?php

namespace Drupal\jsonapi_config\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Common base class for JSON API resource plugins.
 */
abstract class JsonapiResourceBase extends PluginBase implements ContainerFactoryPluginInterface, JsonapiResourceInterface {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }
}
