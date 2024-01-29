<?php snippet('html', slots: true) ?>
  <?php slot('main') ?>
    <?php e(!$page->isHomePage(), Html::tag("h1", $page->publicTitle())); ?>
    <?php snippet('layout', ['layouts' => $page->layout()->toLayouts()]); ?>
    <?php if ($page->isInMenu('primary')) : ?>
      <?php
      snippet('pagination', [
        'hasPrev' => $page->hasPrevInMenu('primary'),
        'hasNext' => $page->hasNextInMenu('primary'),
        'prev' => $page->prevInMenu('primary'),
        'next' => $page->nextInMenu('primary'),
        'prevLabel' =>  $page->hasPrevInMenu('primary') ? $page->prevInMenu('primary')->text() : '',
        'nextLabel' => $page->hasNextInMenu('primary') ? $page->nextInMenu('primary')->text() : '',
        'attrs' => [
          'class' => 'mt-24 border-t-solid absolute bottom-0 vv-site-margin-x:right vv-site-margin-x:left',
        ],
      ]);
      ?>
    <?php endif; ?>
  <?php endslot() ?>
  <?php slot('footer') ?>
    <?php snippet('layout', ['layouts' => $site->footer()->toLayouts()]); ?>
  <?php endslot() ?>
<?php endsnippet();
