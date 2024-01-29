<?php

Kirby::plugin('vv/icons', [

  'blueprints' => [
    'blocks/icon' => __DIR__ . '/blueprints/blocks/icon.yml',
    'fields/icons' => __DIR__ . '/blueprints/fields/icons.yml',
    'files/icon' => __DIR__ . '/blueprints/files/icon.yml',
  ],

  'snippets' => [
    'blocks/icon' => __DIR__ . '/snippets/blocks/icon.php',
  ],

  "translations" => [
    'fr' => [
      'vv-icons.section.icons' => 'Icônes',
      'vv-icons.section.icons.empty' => 'Aucune icône n\'a été téléversée',
      'vv-icons.icons.screenreader.label' => 'Texte lisible par les lecteurs d\'écran',
      'vv-icons.field.icons.select' => 'Sélectionner une icône',
      'vv-icons.field.icons.empty' => 'Aucune icône n\'a été sélectionnée',
      'vv-icons.block.icon' => 'Icône',
    ],
    'en' => [
      'vv-icons.section.icons' => 'Icons',
      'vv-icons.section.icons.empty' => 'No icon uploaded',
      'vv-icons.icons.screenreader.label' => 'Screen reader text',
      'vv-icons.field.icons.select' => 'Select an icon',
      'vv-icons.field.icons.empty' => 'No icon selected',
      'vv-icons.block.icon' => 'Icon',
    ],
  ],
]);
