<?php

require __DIR__ . '/vendor/autoload.php';

$secrets = include __DIR__ . '/kirby.secrets.php';

Kirby\Sane\Svg::$allowedTags['svg'] = ['focusable'];

$urls = [
  "dev" => [
    "localhost" => "http://localhost:3000",
    "vv.test" => "http://vv.test",
  ],

  "production" => "https://" . $_SERVER['SERVER_NAME']
];

$base_url = $urls['dev'][$_SERVER['SERVER_NAME']] ?? $urls['production'];

$env = $urls['dev'][$_SERVER['SERVER_NAME']] ? 'dev' : 'production';

return [

  'roots' => [
    'base'       => __DIR__,

    'content'    => __DIR__ . '/content',

    'site'       => $site = __DIR__ . '/site',
    'config'     => $site . '/config',
    'languages'  => $site . '/config/languages',
    'blueprints' => $site . '/blueprints',

    'index'      => $public  = __DIR__ . '/www',
    'assets'     => $public . '/assets',
    'media'      => $public . '/media',

    'storage'    => $storage = __DIR__ . '/storage',
    'accounts'   => $storage . '/accounts',
    'cache'      => $storage . '/cache',
    'sessions'   => $storage . '/sessions',
    'plugins'    => $storage . '/plugins',
  ],

  'urls' => [
    'index'  => $base_url,
    'assets' => $base_url . '/assets',
    'media'  => $base_url . '/media',
  ],

  'options' => [

    "secrets" => $secrets,

    'env' => $env,

    'afbora.loader.roots' => [
      $storage . '/plugins',
      $site . '/plugins'
    ],

    "afbora.kirby-minify-html" => [
      "enabled" => true,
      "options" => [
        "doRemoveOmittedQuotes" => false,
        "doRemoveOmittedHtmlTags" => false
      ]
    ],

    "diesdasdigital.meta-knight" => [
      "siteTitleAsHomePageTitle" => true,
      "separator" => " | "
    ],

    "kirby3-webp" => true,
    "kirby3-webp.quality" => 90,

    "medienbaecker.autoresize" => [
      "maxWidth" => 1800,
      "maxHeight" => 1800
    ],
  ]
];
