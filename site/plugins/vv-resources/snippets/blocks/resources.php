<?php extract(kirby()->controller('resources.json', compact('page', 'site'))); ?>
<div class="resources" id="ressources">
  <div class="resources__intro">
    <?php snippet('layouts', ['layouts' => $block->content()->introduction()->toLayouts()]) ?>
  </div>
  <div class="resources__header" data-replacementtop="true" data-offset="12">
    <div class="resources__title">
      <h2>
        <?php echo $block->content()->title() ?>
      </h2>
      <?php echo $currentPageIndicator ?>
    </div>
    <div class="resources__filters">
      <?php snippet('resourcetypes'); ?>
    </div>
  </div>
  <div class="resources__content">
    <?php snippet('resources-list', compact('resources')); ?>
  </div>
  <div class="resources__footer">
    <?php echo $pagination ?>
  </div>
</div>