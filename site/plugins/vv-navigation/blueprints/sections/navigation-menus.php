<?php

return function () {

  $fields = [];

  foreach (collection('navigation-menus') as $menu) {
    $fields[$menu['name']] = [
      "width" => "1/2",
      "type" => "navigation",
      "label" => $menu['label'],
      "levels" => $menu['levels'],
      "help" => $menu['help'],
    ];
  }

  return [
    'type' => 'fields',
    'fields' => $fields,
  ];
};
