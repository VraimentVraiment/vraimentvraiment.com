<div>
  <ul class="humans-container flex flex-wrap -m-2">
    <?php foreach (collection('humans')->shuffle() as $human) :?>
      <?php snippet('human', ['human' => $human]);?>
    <?php endforeach; ?>
  </ul>
</div>
<?php snippet('human-modal'); ?>
