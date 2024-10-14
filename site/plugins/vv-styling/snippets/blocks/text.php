<?php
/** @var \Kirby\Cms\Block $block */
?>
<?php
$size = $block->size()->value();
$mobileSize = $block->mobile_size()->value();
$desktopSize = $block->desktop_size()->value();
$align = $block->align()->value();
$mobileAlign = $block->mobile_align()->value();
$vAlign = $block->vertical_align()->value();
$attrs = [
  'class' => A::join(array_filter([
    $size ? 'text--' . $size : null,
    $mobileSize ? 'lt-md:text--' . $mobileSize : null,
    $align ? 'text--' . $align : null,
    $mobileAlign ? 'lt-md:text--' . $mobileAlign : null,
    $vAlign ? 'text--' . $vAlign : null,
  ]), ' '),
];
$text = $block->text()->kt();

if ($size) {
  $text = preg_replace('/<p>/', '<p ' . attr($attrs) . '>', $text);
}

echo $text;
