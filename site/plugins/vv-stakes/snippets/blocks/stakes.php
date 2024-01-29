<div class="stakes-list grid grid-cols-[repeat(auto-fill,minmax(150px,1fr))] gap-8">
  <?php foreach ($site->find('fronts')->children()->listed() as $stake) : ?>
    <?php snippet('stake-link', ['stake' => $stake]);?>
  <?php endforeach; ?>
</div>
