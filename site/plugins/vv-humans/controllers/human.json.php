<?php

return function ($page) {

  $humanSlug = $page->slug();

  $human = collection('humans')->filter(function ($human) use ($humanSlug) {
    return $human->slug() == $humanSlug;
  })->first() ?? null;

  $modalContent = snippet('human-modal-content', compact('human', 'page'), true);
  return compact('modalContent');
};
