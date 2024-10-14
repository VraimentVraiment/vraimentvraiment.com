<!DOCTYPE html>
<html lang="<?php echo $kirby->language(); ?>" class="no-js">
<?php snippet('head'); ?>

<body>
  <?php snippet('header'); ?>
  <div data-taxi>
    <div data-taxi-view>
      <main>
        <div class="main__inner">
          <?php if ($mainContent = $slots->main()) : ?>
            <?php echo $mainContent ?>
          <?php endif ?>
          <?php // echo vite()->js('scripts/pages/' . $page->id() . '/index.js', ['data-taxi-reload'], try: true);?>
        </div>
      </main>
      <footer class="site-footer">
        <div class="site-footer__inner">
          <?php snippet('layouts', ['layouts' => $site->footer()->toLayouts()]); ?>
        </div>
      </footer>
    </div>
  </div>
  <?php echo vite()->js("vite.entry.js");?>
  <?php // echo vite()->js('scripts/pages/' . $page->id() . '/index.js', try: true);?>
  <?php echo vite()->js('scripts/pages/equipe/index.js');?>
  <?php echo vite()->js('scripts/pages/ressources/index.js');?>
  <?php snippet('matomo');?>
  <?php snippet('seo/schemas'); ?>
</body>

</html>
