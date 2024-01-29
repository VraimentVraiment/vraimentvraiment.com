<nav <?php echo attr($attrs);?>>
  <ul>
    <?php foreach ($navItems as $navItem) : ?>
    <li>
      <?php $icon = !$page->isCurrentPage($navItem)
      ? ''
      : Html::tag('span', '', ['class' => 'i-ri-arrow-drop-right-line']);
      ?>
      <?php echo Html::a(
          $navItem->url(),
          [$icon . $navItem->text()],
          $page->isCurrentPage($navItem) ? ['aria-current' => 'page'] : []
      ); ?>
    </li>
    <?php endforeach;?>
  </ul>
</nav>
