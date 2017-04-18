# JSON API Config

The JSON API Config module extends the JSON API module by making resources configurable. 

By default, JSON API enables all config and content entity resources. JSON API Config opt-outs of all resources and lets you
enable resources by creating plugins (à la core REST).

To create a custom JSON API resource in your module, create a new file at `src/Plugin/jsonapi/resource`. Example: `src/Plugin/jsonapi/resource/Article.php`.

A custom `JsonapiResource` is created using the following annotations:

``` php
<?php

namespace Drupal\custom_module\Plugin\jsonapi\Resource;

use Drupal\jsonapi_config\Plugin\JsonapiResourceBase;

/**
 * Provides a resource for Article entities.
 *
 * @JsonapiResource(
 *   id = "node--article",
 *   label = @Translation("Article"),
 *   entity_type = "node",
 *   bundle = "article"
 * )
 */
class Article extends JsonapiResourceBase {

}

```

Where:
* `id` is the the id of the resource.
* `label` is the label of the resource.
* `entity_type` the the entity type of the resource.
* `bundle` is the bundle of the resource

### Note

Since all resources are disabled by default, it is up to you to enable dependent resources. Example a `node` resource might need the `NodeType` resource as well.

``` php
<?php

namespace Drupal\custom_module\Plugin\jsonapi\Resource;

use Drupal\jsonapi_config\Plugin\JsonapiResourceBase;

/**
 * Provides a resource for NodeType config entities.
 *
 * @JsonapiResource(
 *   id = "node_type--node_type",
 *   label = @Translation("Node type"),
 *   entity_type = "node_type",
 *   bundle = "node_type"
 * )
 */
class NodeType extends JsonapiResourceBase {

}
```
