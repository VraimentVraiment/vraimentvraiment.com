<?php

Kirby::plugin('vv/social-medias', [

  'collections' => [
    'social-medias' => function ($site) {
        return $site->socialmedias()->toStructure();
    },
  ],

  'blueprints' => [
    'sections/social-medias' => __DIR__ . '/blueprints/sections/social-medias.yml',
    'blocks/social-medias' => __DIR__ . '/blueprints/blocks/social-medias.yml',
    'fields/social-media' => __DIR__ . '/blueprints/fields/social-media.yml',
  ],

  'snippets' => [
    'blocks/social-medias' => __DIR__ . '/snippets/blocks/social-medias.php',
    'social-media-link' => __DIR__ . '/snippets/social-media-link.php',
  ],
]);
