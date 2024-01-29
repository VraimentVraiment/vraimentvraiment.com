import { animationTimeout } from '@/scripts/lib/animation-timeout';

import { BREAKPOINTS } from '@/scripts/lib/constants';

const ANIMATION_DURATION = 300;

export function createLinkBackground(palette) {
  return (link) => {
    /**
     * Create a background element
     */
    link.classList.add('link-with-background');
    const backgroundElement = document.createElement('div');
    backgroundElement.classList.add('link-background');
    link.appendChild(backgroundElement);

    /**
     * Show background on mouseenter
     */
    const mouseenter = () => {
      if (!link.classList.contains('--enter')) {
        backgroundElement.style.setProperty('--background-color', palette.next);
        link.classList.add('--enter');
      }
    };

    /**
     * Hide background on mouseleave
     */
    const mouseleave = () => {
      if (link.classList.contains('--enter') && !link.classList.contains('--leave')) {
        link.classList.remove('--enter');
        link.classList.add('--leave');

        animationTimeout(() => {
          link.classList.remove('--enter');
          link.classList.remove('--leave');
        }, ANIMATION_DURATION);
      }
    };

    let hasListeners = false;

    /**
     * Listen mouse events on desktop only
     */
    const listenMouseEvents = () => {
      if (window.innerWidth > BREAKPOINTS.MD) {
        if (!hasListeners) {
          hasListeners = true;
          link.addEventListener('hover', mouseenter);
          link.addEventListener('mouseenter', mouseenter);
          link.addEventListener('mouseleave', mouseleave);
        }
      } else {
        hasListeners = false;
        link.removeEventListener('mouseenter', mouseenter);
        link.removeEventListener('hover', mouseenter);
        link.removeEventListener('mouseleave', mouseleave);
      }
    };

    listenMouseEvents();
    window.addEventListener('resize', listenMouseEvents);

    /**
     * Detect tab focus
     */
    link.addEventListener('focus', mouseenter);
    link.addEventListener('blur', mouseleave);
  };
}
