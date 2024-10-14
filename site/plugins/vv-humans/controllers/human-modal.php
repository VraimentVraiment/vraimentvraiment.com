<?php

return function ($humans) {
  $humanSlug = get('focus');

  $human = collection('humans')->filter(function ($human) use ($humanSlug) {
    return $human->slug() == $humanSlug;
  })->first() ?? null;

  $open = isset($human);

  $closeHref = page()->url() . '#equipe';

  $nextHuman = $open ? $humans->nth($humans->indexOf($human) + 1) : null;
  $prevHuman = $open ? $humans->nth($humans->indexOf($human) - 1) : null;

  return compact([
    'human',
    'open',
    'closeHref',
    'nextHuman',
    'prevHuman',
  ]);
};
