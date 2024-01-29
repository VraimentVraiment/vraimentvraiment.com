<?php
$attrs = A::extend([
  'class' => 'tag pl-0',
], $attrs ?? []);
?>
<button <?php echo attr($attrs) ?>>
  <?php echo $label ?>
  <span class='close-tag i-ri:close-fill'></span>
</button>
