<?php

$blueprints = [];
foreach (glob(__DIR__ . '/blueprints/*.yml') as $path) {
  $blueprint = Yaml::read($path);
  $name = basename($path, '.yml');
  $blueprints['pages/' . $name] = $blueprint;
}
$pages_blueprint = Yaml::read(__DIR__ . '/pages.yml');
foreach ($pages_blueprint as $name => $blueprint) {
  $blueprints['pages/' . $name] = $blueprint;
}

Kirby::plugin('vv/pages', [
  'blueprints' => $blueprints,
]);
