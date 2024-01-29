<?php

Kirby::plugin('vv/humans', [

  'collections' => [
    'humans' => function () {
      return page('equipe')->children()->listed();
    },
    'skills' => function () {
      return page('equipe')->content()->skills()->toStructure();
    },
    'expertises' => function () {
      return page('equipe')->content()->expertises()->toStructure();
    },
    'seniority-levels' => function () {
      return page('equipe')->content()->senioritylevels()->toStructure();
    },
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

  'blueprints' => [
    'blocks/humans' => __DIR__ . '/blueprints/blocks/humans.yml',
    'blocks/skills' => __DIR__ . '/blueprints/blocks/skills.yml',
    'pages/humans' => __DIR__ . '/blueprints/pages/humans.yml',
    'pages/human' => __DIR__ . '/blueprints/pages/human.yml',
    'sections/humans' => __DIR__ . '/blueprints/sections/humans.yml',
    'fields/skills' => __DIR__ . '/blueprints/fields/skills.yml',
    'fields/seniority-levels' => __DIR__ . '/blueprints/fields/seniority-levels.yml',
  ],

  'snippets' => [
    'human' => __DIR__ . '/snippets/human.php',
    'human-modal' => __DIR__ . '/snippets/human-modal.php',
    'blocks/humans' => __DIR__ . '/snippets/blocks/humans.php',
    'tag' => __DIR__ . '/snippets/tag.php',
    'blocks/skills' => __DIR__ . '/snippets/blocks/skills.php',
  ],

  'routes' => [
    [
      'pattern' => '/equipe/(:any)',
      'action' => function () {
          return go(page('equipe'), 301);
      },
    ],
  ],
]);
