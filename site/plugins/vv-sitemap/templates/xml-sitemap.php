<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<?php $pages = site()->index()->listed()->inSitemap(); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $page) : ?>
      <url>
      <?php echo Xml::tag('loc', $page->url()) ?>
      <?php echo Xml::tag('lastmod', $page->lastmod()) ?>
      <?php echo Xml::tag('priority', $page->priority()) ?>
      </url>
    <?php endforeach ?>
</urlset>
