import { LinkColors, setLinkAfterBackgroundColor } from '@/scripts/link-colors';
import initNavigation from '@/scripts/navigation';
import COLORS from '@/scripts/colors';

window.onload = function init() {
  const navToggler = document.getElementById('nav-toggler');

  const headerLinks = document.querySelectorAll('header a, header h1.site-logo');

  const pageLinks = document.querySelectorAll('main a, footer a');

  initNavigation(navToggler, headerLinks, pageLinks);

  const linkColors = new LinkColors(COLORS);

  linkColors.shuffle();

  [
    navToggler,
    ...headerLinks,
    ...pageLinks,
  ]
    .forEach(setLinkAfterBackgroundColor(linkColors));
};
