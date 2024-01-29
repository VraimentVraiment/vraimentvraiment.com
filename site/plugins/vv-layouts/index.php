<?php

Kirby::plugin('vv/layouts', [

  'blueprints' => [
    'fields/layout' => __DIR__ . '/blueprints/fields/layout.yml',
    'fields/layout-settings' => __DIR__ . '/blueprints/fields/layout-settings.yml',
    'fields/public-title' => __DIR__ . '/blueprints/fields/public-title.yml',
    'blocks/separator' => __DIR__ . '/blueprints/blocks/separator.yml',
  ],

  'snippets' => [
    'layout' => __DIR__ . '/snippets/layout.php',
    'blocks/nestedlayout' => __DIR__ . '/snippets/blocks/nestedlayout.php',
    'blocks/separator' => __DIR__ . '/snippets/blocks/separator.php',
  ],

  'templates' => [
    'default' => __DIR__ . '/templates/default.php',
  ],

  'pageMethods' => [

    'publicTitle' => function () {
      $public_title = $this->content()->publictitle();
      return $public_title->isNotEmpty() ? $public_title : $this->title();
    },
  ],
]);
