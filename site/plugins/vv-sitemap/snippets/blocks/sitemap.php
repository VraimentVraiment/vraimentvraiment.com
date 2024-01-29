<!-- https://www.sitemaps.org/protocol.html#informing -->
<?php $depth ??= 0;?>
<?php $attrs ??= ['class' => 'sitemap']; ?>
<ul <?php echo attr($attrs);?>>
    <?php foreach ($sitemapPages ??= $site->pages()->inSitemap() as $page) : ?>
      <li class="<?php echo $depth === 0 ? 'mt-4' : 'mt-2';?>">
      <?php echo Html::a(
          $page->url(),
          [Html::tag('p', $page->title(), ['class' =>  $depth === 0 ? 'text-xl' : 'text-lg'])]
      )?>
      <?php if ($page->hasChildren()) : ?>
        <?php snippet(
            'blocks/sitemap',
            [
              'sitemapPages' => $page->children()->inSitemap(), 'attrs' => ['class' => 'pl-8'], 'depth' => $depth + 1
            ]
        ) ?>
      <?php endif;?>
    </li>
    <?php endforeach;?>
</ul>
