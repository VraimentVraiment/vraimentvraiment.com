<?php

$humanspage = option('vv.humans.humanspage');

return [
  'type' => 'pages',
  'label' => 'Humains',
  'parent'    => "kirby.page('$humanspage')",
  'template' => 'human',
  'search' => true,
];
