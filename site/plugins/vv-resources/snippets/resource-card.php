<div class="resource-card" data-id="<?php echo $id ?>" data-order="<?php echo $order ?>">
  <?php if ($carousel) : ?>
    <?php echo $carousel ?>
  <?php elseif ($image) : ?>
    <?php snippet('figure', ['file' => $image, 'ratio' => '3/2']) ?>
  <?php endif ?>
  <h3 class="resource-card__title">
    <?php echo $title ?>
  </h3>
  <div class="resource-card__description">
    <?php echo $description ?>
  </div>
</div>
