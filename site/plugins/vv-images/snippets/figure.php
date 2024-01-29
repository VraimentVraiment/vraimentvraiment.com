<figure <?php echo attr(A::extend($attrs, ['class' => 'm-0'])); ?>>
  <picture>
    <?php if ($webp = $image->siblings()->findBy('filename', $image->name() . '.webp')) : ?>
    <source srcset="<?php echo $webp->url();?>" type="image/webp">
    <?php endif;?>
    <img <?php
    echo attr([
      'class' => 'w-full object-cover',
      'src' => $image->url(),
      'alt' => A::get($attrs, 'alt') ?? $image->alt()->value() ?? '',
      'aria-hidden' => 'true',
    ]); ?>>
  </picture>
  <?php if ($image->legend()->isNotEmpty()) : ?>
  <figcaption class="mt-2 flex justify-center">
    <?php echo $image->legend()->kirbytext() ?>
  </figcaption>
  <?php endif; ?>
</figure>
