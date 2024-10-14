<?php $humans = collection('humans')->shuffle(); ?>
<ul class="humans-container k-grid" id="equipe">
  <?php foreach ($humans as $human) :?>
  <li class="human-card k-grid-item">
    <?php snippet('human', compact('human'));?>
  </li>
  <?php endforeach; ?>
</ul>
<?php snippet('human-modal', compact('humans', 'page')); ?>
