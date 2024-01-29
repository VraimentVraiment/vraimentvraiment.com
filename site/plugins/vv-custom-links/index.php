<?php

require_once __DIR__ . '/models/custom-link-block.php';

$custom_link_types = Yaml::read(__DIR__ . '/custom-link-types.yml');

Kirby::plugin('vv/custom-links', [

  'collections' => [
    'custom-link-types' => function () use ($custom_link_types) {
        return $custom_link_types;
    },
  ],

  'blueprints' => [
    'blocks/custom-link' => Data::read(__DIR__ . '/blueprints/blocks/custom-link.yml'),
    'fields/custom-link-type' => include __DIR__ . '/blueprints/fields/custom-link-type.php',
  ],

  'snippets' => [
    'blocks/custom-link' => __DIR__ . '/snippets/blocks/custom-link.php',
  ],

  'blockModels' => [
    'custom-link' => CustomLinkBlock::class,
  ],
]);
