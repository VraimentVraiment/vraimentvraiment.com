<?php

use Kirby\Content\Content;

Kirby::plugin('vv/kirby-styling', [
  'blueprints' => [
    'blocks/text' => __DIR__ . '/blueprints/blocks/text.yml',
    'blocks/custom_heading' => __DIR__ . '/blueprints/blocks/custom_heading.yml',
    /**
     * For some reason, overriding the default heading block doesn't work on remote server.
     * We create a "custom_heading" block instead.
     */
    'blocks/spacing' => __DIR__ . '/blueprints/blocks/spacing.yml',
  ],
  'snippets' => [
    'blocks/text' => __DIR__ . '/snippets/blocks/text.php',
    'blocks/custom_heading' => __DIR__ . '/snippets/blocks/custom_heading.php',
    'blocks/spacing' => __DIR__ . '/snippets/blocks/spacing.php',
  ],
]);
