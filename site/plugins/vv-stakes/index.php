<?php

Kirby::plugin('vv/stakes', [

  'blueprints' => [
    'pages/stakes' => __DIR__ . '/blueprints/pages/stakes.yml',
    'pages/stake' => __DIR__ . '/blueprints/pages/stake.yml',
    'sections/stakes' => __DIR__ . '/blueprints/sections/stakes.yml',
    'blocks/stakes' => __DIR__ . '/blueprints/blocks/stakes.yml',
    'fields/punchlinecolor' => __DIR__ . '/blueprints/fields/punchlinecolor.yml',
  ],

  'templates' => [
    'stake' => __DIR__ . '/templates/stake.php',
  ],

  'snippets' => [
    'stake-link' => __DIR__ . '/snippets/stake-link.php',
    'blocks/stakes' => __DIR__ . '/snippets/blocks/stakes.php',
  ],
]);
