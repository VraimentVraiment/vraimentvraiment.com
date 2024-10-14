<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$level = $block->level()->or('h2');
$size = $block->size()->value();
$mobileSize = $block->mobile_size()->value();
$attrs = attr([
  'class' => A::join(array_filter([
    $size ? 'heading--' . $size : null,
    $mobileSize ? 'lt-md:heading--' . $mobileSize : null,
  ]), ' '),
]); ?>
<<?php echo $level ?> <?php echo $attrs ?>>
  <?php echo $block->text() ?>
</<?php echo $level ?>>
