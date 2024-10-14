<?php

return function ($human) {
  $dataSkills = $human->expertises()->split();
  $gender = $human->gender();
  $firstname = $human->firstname();
  $name = $human->name();
  $job = $human->job();

  $ariaLabel = 'En savoir plus sur ' . $firstname . ' ' . $name;
  $alt = 'Portrait de ' . $firstname . ' ' . $name;

  $attrs = attr([
    'aria-label' => $ariaLabel,
    // 'aria-controls' => 'human-modal',
    'class' => 'human',
    'data-skills' => $dataSkills,
    'data-gender' => $gender,
    'data-slug' => $human->slug(),
  ]);

  $innerAttrs = attr([
    'href' => $human->url(),
    'tabindex' => '0',
    'class' => 'human__inner',
  ]);

  $cover = $human->cover()->isNotEmpty()
  ? snippet('figure', [
    'file' => $human->cover()->toFile(),
    'options' => [
      'ratio' => '1/1',
      'imgAttributes' => [
        'shared' => [
          'class' => 'human-cover',
          'alt' => $alt,
          'sizes' => '100vw',
        ],
      ]
    ],
  ], true)
  : null;

  $senioritySlug = $human->seniority()->value();
  $seniority = page()->getSeniorityLevel($senioritySlug, $gender->value());
  $seniorityDetails = page()->getSeniorityLevelDetails($senioritySlug);

  $rawSkills = $human->skills()->isNotEmpty()
  ? $human->skills()->split()
  : [];
  $skills = [];
  foreach ($rawSkills as $skill) {
    $skillDetail = page()->getSkill($skill);
    if ($skillDetail) {
      $skills[] = $skillDetail->name();
    }
  }

  return compact([
    'attrs',
    'innerAttrs',
    'cover',
    'firstname',
    'name',
    'job',
    'seniority',
    'seniorityDetails',
    'skills'
  ]);
};
