<?php foreach (collection('social-medias') as $socialMedia) : ?>
  <?php snippet('social-media-link', ['socialMedia' => $socialMedia]); ?>
<?php endforeach;
