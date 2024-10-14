<?php

return function ($id = null, $open = false) {
  $id ??= Uuid::generate();

  $open ??= false;
  $attrs = attr([
    'role' => 'dialog',
    'aria-modal' => 'true',
    'tabindex' => '0',
    'class' => 'modal' . ($open ? ' is-open' : ''),
    'id' => $id,
  ]);

  return compact([
    'attrs',
    'open',
    'id'
  ]);
};
