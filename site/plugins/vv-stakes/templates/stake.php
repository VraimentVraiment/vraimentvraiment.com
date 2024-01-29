<?php $isSmall = $page->content()->punchlinelayout()->value() === 'small'; ?>
<?php snippet('html', slots: true) ?>
  <?php slot('main') ?>
  <div class="grid">
  <header class="stake-header md:-mt-8 col-start-1 col-span-4 row-start-1 row-span-1">
    <?php echo Html::tag("h1", $page->title(), ['class' => 'mb-6']);?>
    <?php echo Html::tag("p", $page->baseline()->text());?>
  </header>
    <div class="stake-pagination z-10 row-start-2 row-span-4 col-start-1 col-span-4 pointer-events-none">
      <div class="sticky top-24 pointer-events-auto">
        <?php snippet(
            'pagination',
            [
              'hasPrev' => $page->hasPrev(),
              'hasNext' => $page->hasNext(),
              'prev' => $page->prev(),
              'next' => $page->next(),
              'prevLabel' => 'Précédent',
              'nextLabel' => 'Suivant',
              'attrs' => [
                'class' => 'border-b-solid position-inherit'
              ],
            ]
        );?>
      </div>
    </div>
    <article <?php
    echo attr([
      "class" => A::join([
        'stake-text mt-17 py-24 col-start-1 col-span-4 row-start-3',
        ($isSmall ? 'md:pr-24 md:col-start-1 md:col-span-2 md:row-start-2' : ''),
      ], ' ')
    ]);
    ?>>
        <?php echo $page->text()->kirbytext();?>
    </article>
    <?php $page->figure(
        $page->content()->punchline()->toFile(),
        [
          "class" => A::join([
            "punchline mt-17 col-start-1 col-span-4 row-start-2 -mb-32 py-12",
            $page->content()->punchlinecolor()->value(),
            ($isSmall ? 'md:py-24 md:col-start-3 md:col-span-2 md:mb-0' : '')
          ], ' ')
        ]
    );?>
    <?php $page->figure(
        $page->content()->cover()->toFile(),
        [
          "class" => A::join([
            "cover col-start-1 col-span-4 row-start-4",
            ($isSmall ? 'md:row-start-3' : '')
          ], ' ')
        ]
    );?>
  </div>
  <?php endslot() ?>
  <?php slot('footer') ?>
    <?php snippet('layout', ['layouts' => $site->footer()->toLayouts()]); ?>
  <?php endslot() ?>
<?php endsnippet();
