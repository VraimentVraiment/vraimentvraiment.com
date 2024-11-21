<ul class="resources-list k-grid--lg">
  <?php foreach ($resources as $resource) : ?>
  <li class="resource-card k-grid-item">
    <?php snippet('resource-card', compact('resource')); ?>
  </li>
  <?php endforeach; ?>
</ul>
