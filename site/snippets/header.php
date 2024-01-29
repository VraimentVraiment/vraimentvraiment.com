<?php

// phpcs:disable Generic.Files.LineLength.TooLong

?>

<header class="site-header border-b-solid fixed left-0 right-0 z-900 flex justify-between items-center py-8 vv-site-margin-x:mx">
  <?php echo Html::tag(
      $page->isHomePage() ? 'h1' : 'a',
      [svg('assets/vv-logo.svg')],
      A::extend(
          ['class' => 'site-logo h-8'],
          $page->isHomePage() ? [
            'aria-current' => 'page',
          ] : [
            'href' => site()->url(),
            'aria-label' => 'Retour à l\'accueil',
          ]
      )
  );?>
  <button
    id="nav-toggler"
    aria-label="Ouvrir le menu de navigation"
    aria-haspopup="true"
    aria-controls="main-nav"
    tabindex="0"
    class="h-8 w-12 p-0 text-2xl"
  >
  <span class="nav-toggler__closed">
    <?php echo svg('assets/menu-menu.svg') ?>
  </span>
  <span class="nav-toggler__open">
    <div class='i-ri:close-fill'></div>
  </span>
  </button>
  <?php snippet('navigation-menu', $site->navigation('primary'));?>
</header>
