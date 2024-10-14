<?php snippet('html', slots: true) ?>
  <?php slot('main') ?>
    <?php snippet('layouts', ['layouts' => $page->layout()->toLayouts()]); ?>
    <?php if ($page->isInMenu('primary')) : ?>
      <?php snippet('cross-navigation', compact('page')); ?>
    <?php endif; ?>
  <?php endslot() ?>
<?php endsnippet();
