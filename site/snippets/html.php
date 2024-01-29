<!DOCTYPE html>
<html lang="<?php echo $kirby->language(); ?>">
  <?php snippet('head'); ?>
  <body>
    <?php snippet('header'); ?>
    <main
    <?php
    echo attr([
      'class' => A::join([
        'relative vv-site-margin-x:px pt-16',
        ($page->isHomePage() ? 'home pb-16' : 'pb-32'),
      ], ' '),
    ]);
    ?>>
      <?php if ($main = $slots->main()) : ?>
        <?php echo $main ?>
      </main>
      <?php endif ?>
    <footer class="site-footer border-t-solid vv-site-margin-x:mx py-16 md:py-8">
      <?php if ($footer = $slots->footer()) : ?>
        <?php echo $footer ?>
      <?php endif ?>
    </footer>
    <?php echo vite()->js("vite.entry.js");?>
    <?php echo vite()->js('scripts/pages/' . $page->id() . '/index.js', try: true);?>
    <?php if ($site->isProdEnv()) : ?>
      <?php snippet('matomo');?>
    <?php endif; ?>
  </body>
</html>
