<?php

Kirby::plugin('vv/sitemap', [

  'options' => [
    'ignore' => [
      "error",
      "equipe\/.*",
    ]
  ],

  'blueprints' => [
    'blocks/sitemap' => [
      'name' => 'Plan du site',
      'icon' => 'url',
    ],
  ],

  'snippets' => [
    'blocks/sitemap' => __DIR__ . '/snippets/blocks/sitemap.php',
  ],

  'templates' => [
    'xml-sitemap' => __DIR__ . '/templates/xml-sitemap.php',
  ],

  'pagesMethods' => [
    'inSitemap' => function () {
      $expression = '/' . A::join(A::map(option('vv.sitemap.ignore'), function ($item) {
        return '(' . $item . ')';
      }), '|') . '/';
      return $this->filterBy('url', '!*', $expression);
    },
  ],

  'pageMethods' => [
    'lastmod' => function () {
      return $this->modified('c', 'date');
    },
    'priority' => function () {
      return $this->isHomePage() ? 1 : number_format(0.5 / $this->depth(), 1);
    },
  ],

  'routes' => [
    [
      'pattern' => 'sitemap',
      'action' => function () {
        return go('sitemap.xml', 301);
      },
    ],
    [
      'pattern' => 'sitemap.xml',
      'action' => function () {
        return new Response(tpl::load(__DIR__ . '/xml-sitemap.php', []), 'application/xml');
      },
    ],
  ],
]);
