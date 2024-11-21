<?php snippet('html', slots: true) ?>
<?php slot('main') ?>
<div class="back-link">
  <a href="<?= page('ressources')->url() ?>">
    <span class="back-link__icon"></span>
    Toutes les ressources
  </a>
</div>
<article class="resource-page">
  <div class="resource-page__container">
    <div class="resource-page__content">
      <header class="resource-page__header">
        <h1 class="resource-page__title"><?php echo $title ?></h1>
      </header>
      <div class="resource-page__description">
        <?php echo $description ?>
      </div>
    </div>
    <div class="resource-page__main-image">
      <?php if ($mainImage) : ?>
        <?php echo $mainImage ?>
      <?php endif ?>
    </div>
  </div>
  <?php if ($images) : ?>
  <div class="resource-page__images">
    <?php foreach ($images as $image) : ?>
    <div class="resource-page__image">
      <?php snippet('figure', ['file' => $image, 'ratio' => '3/2']) ?>
    </div>
    <?php endforeach ?>
  </div>
  <?php endif ?>
</article>
<?php endslot() ?>
<?php endsnippet() ?>
