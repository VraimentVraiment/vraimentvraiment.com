<?php

/** phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols */

use Kirby\Uuid\Uuid;

return [
  'debug' => false,
  'languages' => true,
  'languages.detect' => true,

  'tobimori.seo.robots.content' => "User-agent: *\nAllow: /\nDisallow: /panel",

  'smartypants' => true,

  'tobimori.seo' => [
    'canonicalBase' => 'https://vraimentvraiment.com',
    'lang' => 'fr_FR',
    'sitemap' => [
      'excludeTemplates' => ['human', 'resource'],
    ],
  ],

  'shallowred.html-sitemap.ignore' => [
    "error",
    "equipe\/.*",
    "ressources\/.*",
  ],

  'shallowred.navigation-menus' => [
    'menus' => [
      'primary' => [
        'name' => 'primaryNavigation',
        'label' => 'Menu de navigation principal',
        'id' => 'main-nav',
        'ariaLabel' => 'Menu principal',
      ],
      'secondary' => [
        'name' => 'secondaryNavigation',
        'label' => 'Menu de navigation secondaire',
        'id' => 'sec-nav',
        'ariaLabel' => 'Menu secondaire',
      ],
    ]
  ],

  'vv.humans' => [
    'humanspage' => 'equipe',
  ],

  'timnarr.imagex' => [
    'cache' => true,
    'customLazyloading' => false,
    'formats' => ['avif', 'webp'],
    'includeInitialFormat' => false,
    'noSrcsetInImg' => false,
    'relativeUrls' => false,
  ],

  'thumbs' => [
    'srcsets' => [
      'default' => [
        '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 80],
        '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 80],
        '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 80],
      ],
      'default-webp' => [
        '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
        '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
        '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
      ],
      'default-avif' => [
        '400w'  => ['width' =>  400, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
        '800w'  => ['width' =>  800, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
        '1200w' => ['width' => 1200, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
      ],
    ],
  ],

  'routes' => [
    [
      'pattern' => 'medias',
      'action'  => function () {
        return go('contact');
      }
    ],
    [
      'pattern' => 'fronts',
      'action'  => function () {
        return go('agence');
      }
    ],
    [
      'pattern' => 'fronts/(:any)',
      'action'  => function ($slug) {
        return go('agence');
      }
    ],
    [
      'pattern' => 'menu',
      'action'  => function () {
          return Page::factory([
            'slug' => 'static-menu',
            'template' => 'static-menu',
            'model' => 'static-menu',
            'content' => [
              'title' => 'Menu statique',
              'uuid'  => Uuid::generate(),
            ]
          ]);
      }
    ]
  ],

  "afbora.kirby-minify-html" => [
    "enabled" => true,
    "options" => [
      "doRemoveOmittedQuotes" => false,
      "doRemoveOmittedHtmlTags" => false
    ]
  ],

  'ready' => function () {

      return [
        'sylvainjule.matomo' => option('secrets.sylvainjule.matomo'),

        'cache' => [
          'pages' => [
            'active'  => false,
            // 'active'  => option('env') !== 'development',
            // 'type'    => 'static',
            // 'prefix' => 'vraimentvraiment.com/pages',
            // 'root'   => kirby()->root('index') . '/cache',
          ]
        ],
      ];
  },

  'hooks' => [
    'kirbytext:before' => function ($text) {
      // Function to determine link type and return appropriate icon class
      if (!function_exists('getLinkIconClass')) {
        function getLinkIconClass($href, $isGeo)
        {
          if ($isGeo) {
            return 'i-ri-map-pin-2-line';
          } elseif (preg_match('/^mailto:/', $href)) {
            return 'i-ri-mail-line';
          } elseif (preg_match('/^https?:\/\//', $href)) {
            return 'i-ri-external-link-line';
          } elseif (preg_match('/^tel:/', $href)) {
            return 'i-ri-phone-line';
          } else {
            return 'i-ri-arrow-right-line';
          }
        }
      }

      // Insert icon into anchor tags
      $text = preg_replace_callback('/<a\s+([^>]*href="([^"]+)"[^>]*)>(.*?)<\/a>/', function ($matches) {
        $isGeo = preg_match('/data-isgeo="true"/', $matches[1]);
        $iconClass = 'link__icon ' . getLinkIconClass($matches[2], $isGeo);
        $icon = Html::span('', ['class' => $iconClass]);
        $linkText = Html::span([$matches[3]], ['class' => 'link__text']);
        return '<a ' . $matches[1] . '>' . $linkText . $icon . '</a>';
      }, $text);

      return $text;
    },

    'shallowred.layouts.layoutClassList' => function ($attrs, $classes) {

      if ($attrs->full_height()->toBool()) {
        $classes[] = 'k-row--full-height';
      }
      if ($flex_direction = $attrs->flex_direction()->value()) {
        $classes[] = 'k-row--flex-direction-' . $flex_direction;
      }
      if ($flex_direction = $attrs->mobile_flex_direction()->value()) {
        $classes[] = 'k-row--mobile_flex-direction-' . $flex_direction;
      }
      if ($align_items = $attrs->align_items()->value()) {
        $classes[] = 'k-row--align-items-' . $align_items;
      }
      if ($attrs->slide_up()->toBool()) {
        $classes[] = 'k-row--slide-in-up';
      }
      if ($gap = $attrs->cols_gap()->value()) {
        $classes[] = 'k-row--cols_gap-' . $gap;
      }
      if ($gap = $attrs->mobile_cols_gap()->value()) {
        $classes[] = 'k-row--mobile_cols_gap-' . $gap;
      }
      if ($gap = $attrs->blocks_gap()->value()) {
        $classes[] = 'k-row--blocks_gap-' . $gap;
      }
      if ($gap = $attrs->mobile_blocks_gap()->value()) {
        $classes[] = 'k-row--mobile_blocks_gap-' . $gap;
      }
      return $classes;
    },
  ],
];
