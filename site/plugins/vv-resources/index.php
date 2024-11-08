<?php

Kirby::plugin('vv/resources', [

  'collections' => [
    'resources' => function () {
      return page('ressources')->children()->listed();
    },
    'resourcetypes' => function () {
      return site()->content()->resourcetypes()->toStructure();
    },
  ],

  'blueprints' => [
    'pages/resources' => __DIR__ . '/blueprints/pages/resources.yml',
    'pages/resource' => __DIR__ . '/blueprints/pages/resource.yml',
    'sections/resources' => __DIR__ . '/blueprints/sections/resources.yml',
    'sections/resourcetypes' => __DIR__ . '/blueprints/sections/resourcetypes.yml',
    'blocks/resources' => __DIR__ . '/blueprints/blocks/resources.yml',
  ],

  'snippets' => [
    'blocks/resources' => __DIR__ . '/snippets/blocks/resources.php',
    'resources-list' => __DIR__ . '/snippets/resources-list.php',
    'resourcetypes' => __DIR__ . '/snippets/resourcetypes.php',
    'resource' => __DIR__ . '/snippets/resource.php',
    'resource.controller' => require_once __DIR__ . '/controllers/resource.php',
  ],

  "templates" => [
    "resources" => __DIR__ . '/templates/resources.php',
    "resources.json" => __DIR__ . '/templates/resources.json.php',
  ],
  "controllers" => [
    "resources.json" => require_once __DIR__ . '/controllers/resources.json.php',
  ],

  'siteMethods' => [
    'getResourceTypeTag' => function ($resourcetype) {
      return site()->getParamTag(
          $url = '/ressources#ressources',
          $key = $resourcetype->slug()->value(),
          $label = $resourcetype->pluralName(),
          $paramName = 'resourcetype'
      );
    },
  ],

  'routes' => [
    [
      'pattern' => '/ressources/(:any)',
      'action' => function () {
          return go(page('ressources'), 301);
      },
    ],
  ],
]);
