<?php

$navigation_menus = Yaml::read(__DIR__ . '/navigation-menus.yml');

Kirby::plugin('vv/navigation', [

  'collections' => [
    'navigation-menus' => function () use ($navigation_menus) {
      return $navigation_menus;
    },
  ],

  'blueprints' => [
    'blocks/navigation-menu' => include __DIR__ . '/blueprints/blocks/navigation-menu.php',
    'sections/navigation-menus' => include __DIR__ . '/blueprints/sections/navigation-menus.php',
  ],

  'snippets' => [
    'blocks/navigation-menu' => __DIR__ . '/snippets/blocks/navigation-menu.php',
    'navigation-menu' => __DIR__ . '/snippets/navigation-menu.php',
  ],

  'siteMethods' => [

    'navItems' => function ($menuName) {
      $menu = collection('navigation-menus')[$menuName];
      $navItems = $this->content()->get($menu['name'])->toStructure();
      return $navItems;
    },

    'navigation' => function ($menuName) {
      $menu = collection('navigation-menus')[$menuName];
      return [
        'navItems' => $this->navItems($menuName),
        'id' => $menu['id'],
        'ariaLabel' => $menu['ariaLabel'],
        'attrs' => [
          'id' => $menu['id'],
          'role' => 'navigation',
          'aria-label' => $menu['ariaLabel'],
        ],
      ];
    },

  ],

  'pageMethods' => [
    'isCurrentPage' => function ($navItem) {
      return $navItem->url()->toString() === "/" . $this->slug();
    },

    'isInMenu' => function ($menuName) {
      $navItems = site()->navItems($menuName);
      $isInMenu = A::some($navItems->toArray(), function ($navItem) {
        return $navItem['url'] === "/" . $this->slug();
      });
      return $isInMenu;
    },

    'hasPrevInMenu' => function ($menuName) {
      return $this->prevInMenu($menuName) !== null;
    },

    'prevInMenu' => function ($menuName) {
      $navItems = site()->navItems($menuName);
      $index = $navItems->indexOf($this->uid());

      if ($index === 0) {
        return null;
      }

      return $navItems->nth($index - 1);
    },

    'hasNextInMenu' => function ($menuName) {
      return $this->nextInMenu($menuName) !== null;
    },

    'nextInMenu' => function ($menuName) {
      $navItems = site()->navItems($menuName);
      $index = $navItems->indexOf($this->uid());

      if ($index === $navItems->count() - 1) {
        return null;
      }

      return $navItems->nth($index + 1);
    },
  ],

]);
