export default function initNavigation(navToggler, links) {
  const header = document.querySelector('header');
  const homePageLogo = header.querySelector('h1');

  function toggleNavDisplay() {
    document.body.classList.toggle('overflow-hidden');

    header.classList.toggle('open');
    const isOpen = header.classList.contains('open');
    navToggler.setAttribute('aria-expanded', isOpen);

    links.forEach((link) => {
      link?.setAttribute?.('tabindex', isOpen ? '-1' : '0');
    });
  }

  navToggler.addEventListener('click', () => {
    toggleNavDisplay();
  });

  homePageLogo?.addEventListener('click', () => {
    if (header.classList.contains('open')) {
      toggleNavDisplay();
    }
  });
}
