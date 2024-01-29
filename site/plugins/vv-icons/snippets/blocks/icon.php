<?php

$file = $block->icon()->toFile()->read();
$screenreaderText = $block->screenreader() ? Html::tag('span', $block->screenreader(), ['class' => 'read-only']) : '';

echo Html::div(
    [
      $file,
      $screenreaderText,
    ],
    ['class' => 'icon']
);
