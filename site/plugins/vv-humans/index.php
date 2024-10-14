<?php

use Kirby\Http\Query;

// use Kirby\Http\Params;

Kirby::plugin('vv/humans', [

  'collections' => [
    'humans' => function () {
      $humanspage = option('vv.humans.humanspage');
      return page($humanspage)->children()->listed();
    },
    'skills' => function () {
      return site()->content()->skills()->toStructure();
    },
    'expertises' => function () {
      return site()->content()->expertises()->toStructure();
    },
    'seniority-levels' => function () {
      return site()->content()->senioritylevels()->toStructure();
    },
  ],

  'blueprints' => [
    'blocks/humans' => __DIR__ . '/blueprints/blocks/humans.yml',
    'blocks/skills' => __DIR__ . '/blueprints/blocks/skills.yml',
    'pages/humans' => __DIR__ . '/blueprints/pages/humans.yml',
    'pages/human' => __DIR__ . '/blueprints/pages/human.yml',
    'sections/humans' => require_once __DIR__ . '/blueprints/sections/humans.php',
    'fields/skills' => __DIR__ . '/blueprints/fields/skills.yml',
    'fields/seniority-levels' => __DIR__ . '/blueprints/fields/seniority-levels.yml',
  ],

  'templates' => [
    'human' => __DIR__ . '/templates/human.php',
    'human.json' => __DIR__ . '/templates/human.json.php',
  ],

  'controllers' => [
    'human.json' => require_once __DIR__ . '/controllers/human.json.php',
  ],

  'snippets' => [
    'human' => __DIR__ . '/snippets/human.php',
    'human.controller' => __DIR__ . '/controllers/human-content.php',
    'human-modal.controller' => __DIR__ . '/controllers/human-modal.php',
    'human-modal-content' => __DIR__ . '/snippets/human-modal-content.php',
    'human-modal-content.controller' => __DIR__ . '/controllers/human-content.php',
    'human-modal' => __DIR__ . '/snippets/human-modal.php',
    'blocks/humans' => __DIR__ . '/snippets/blocks/humans.php',
    'blocks/skills' => __DIR__ . '/snippets/blocks/skills.php',
  ],

  'siteMethods' => [
    'getHumanController' => require_once __DIR__ . '/controllers/human.php',
  ],

  'pageMethods' => [

    'getSkill' => function ($slug) {
      return collection('skills')->filter(function ($skill) use ($slug) {
        return $skill->slug() == $slug;
      })->first();
    },

    'getSeniorityLevel' => function ($inclusivename, $gender = null) {
      $level = collection('seniority-levels')->filter(function ($seniorityLevel) use ($inclusivename) {
        return $seniorityLevel->inclusivename() == $inclusivename;
      })->first();

      if (!$level) {
        return;
      }

      if ($gender && $gender === 'male' && $level->masculinename()->isNotEmpty()) {
        return $level->masculinename();
      } elseif ($gender && $gender === 'female' && $level->femininename()->isNotEmpty()) {
        return $level->femininename();
      } else {
        return $level->inclusivename();
      }
    },

    'getSeniorityLevelDetails' => function ($inclusivename) {
      $level = collection('seniority-levels')->filter(function ($seniorityLevel) use ($inclusivename) {
        return $seniorityLevel->inclusivename() == $inclusivename;
      })->first();

      if (!$level) {
        return;
      }

      return $level->details()->escape();
    },
  ],

  'routes' => function () {
    $humanspage = option('vv.humans.humanspage');
    return [
      [
        'pattern' => '/' . $humanspage . '/(:any)',
        'action' => function ($slug) use ($humanspage) {
          if (str_ends_with($slug, '.json')) {
            $this->next();
          }
          $params = new Query([
          // $params = new Params([
            'focus' => $slug,
          ]);
          return go(page($humanspage)->url() . '?' . $params . '#equipe');
        },
      ],
    ];
  },
]);
