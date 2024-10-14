<?php

$size = $block->size()->value();
$mobileSize = $block->mobile_size()->value();
$desktopSize = $block->desktop_size()->value();
$attrs = [
  'class' => A::join(array_filter([
    'spacing',
    $size ? 'spacing--' . $block->size()->value() : null,
    $mobileSize ? 'lt-md:spacing--' . $block->mobile_size()->value() : null,
  ]), ' '),
];

echo Html::tag('div', '', $attrs);
