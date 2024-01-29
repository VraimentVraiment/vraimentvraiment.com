import { createLinkBackground } from '@/scripts/lib/create-link-background';
import { ShuffledPallete } from '@/scripts/lib/shuffled-palette';
import initNavigation from '@/scripts/lib/navigation';
import { COLORS } from '@/scripts/lib/constants';

window.onload = function init() {
  const navToggler = document.getElementById('nav-toggler');
  const links = document.querySelectorAll('header a, header h1.site-logo, main a, main button, footer a, .tag, .human, .link');

  initNavigation(navToggler, links);

  const palette = new ShuffledPallete(COLORS);
  palette.shuffle();

  [
    navToggler,
    ...links,
  ]
    .forEach(createLinkBackground(palette));
};
