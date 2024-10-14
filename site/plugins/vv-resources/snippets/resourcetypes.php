<ul class="resourcetypes__list">
  <?php foreach (collection('resourcetypes') as $resourcetype) : ?>
  <li class="resourcetypes__item">
    <?php echo $site->getResourceTypeTag($resourcetype); ?>
  </li>
  <?php endforeach ?>
</ul>