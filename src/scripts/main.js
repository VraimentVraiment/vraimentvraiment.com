import { initCarousels, watchNewCarousels } from '@/scripts/lib/carousels'
import { COLORS, LEAVE_PAGE_DELAY, SLIDE_ANIMATION_DURATION } from '@/scripts/lib/constants'
import { initLinksBackgrounds, watchNewLinkBackgrounds } from '@/scripts/lib/link-background'
import { initMainNavigationMenu } from '@/scripts/lib/main-navigation-menu'
import { initSmoothNav } from '@/scripts/lib/smooth-nav'
import { animationTimeout } from '@/scripts/utils/animation-timeout'
import { isMobile } from '@/scripts/utils/detect-mobile'
import { observeIntersection } from '@/scripts/utils/observe-intersection'

/**
 * Every link which is not part of the main navigation menu.
 * We need to :
 * - set their tabindex attribute to -1 when the main nav is open, so they are not focusable ;
 * - set their tabindex attribute to 0 when the main nav is closed, so they are focusable.
 */
const NON_MAIN_NAV_LINKS_SELECTORS = [
  'main a',
  'main button',
  'footer a',
  '#human-modal a', /** might not be in main el  */
]

/**
 * Every link that has a background element,
 * and might not be there on first load.
 */
const WATCH_LINKS_WITH_BACKGROUND_SELECTORS = [
  'a',
  'button',
]

/**
 * Every link that might have an aria-current="page" attribute
 * We need to update this attribute when the page changes
 */
const NAV_LINKS_SELECTORS = [
  'a.site-logo',
  'nav a',
]

/**
 * Every element that might trigger a scroll animation when entering the viewport
 */
const SCROLL_SELECTORS = [
  '.k-row--slide-in-up',
  '.human',
]

/**
 * Every anchor that should not trigger a smooth navigation transition
 */
const SMOOTH_NAV_IGNORE = [
  '#nav-toggler',
  '.tag',
  '.human__pagination a',
  '.collection-pagination a',
  '.carousel a',
  'a.human',
  '.resource a',
]

document.documentElement.classList.replace('no-js', 'js')
window.addEventListener('DOMContentLoaded', main)

function getHeaderNavlinks() {
  return [...document.querySelectorAll('.site-header nav a')]
    .map(link => ({
      hoverTarget: link,
      backgroundElement: link.querySelector('span:not(.current-page-icon)'),
    }))
}

function updateCurrentNavitem() {
  const navLinks = document.querySelectorAll(NAV_LINKS_SELECTORS.join(','))
  const href = (window.location.origin + window.location.pathname).replace(/\/$/, '')
  navLinks.forEach((link) => {
    link.removeAttribute('aria-current')
    link.setAttribute('tabindex', '0')
  })

  const currentPageLinks = document.querySelectorAll(`${NAV_LINKS_SELECTORS.map(s => `${s}[href="${href}"]`).join(',')}`)
  if (currentPageLinks.length > 0) {
    animationTimeout(() => {
      currentPageLinks.forEach((link) => {
        link.setAttribute('aria-current', 'page')
        link.setAttribute('tabindex', '-1')
      })
    }, SLIDE_ANIMATION_DURATION)
  }
}

function repositionModals() {
  /**
   * Make sure modal el is within main element before taxi triggers an animation
   * We might have moved it out for better z-index stacking
   */
  const main = document.querySelector('main')
  const modalHider = document.getElementById('modal-hider')
  const modalEl = document.getElementById('human-modal')

  if (modalHider) {
    main.appendChild(modalHider)
  }
  if (modalEl) {
    main.appendChild(modalEl)
  }
}

function focusFirstElement() {
  const firstFocusableElement = document.querySelector('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])')
  if (firstFocusableElement) {
    firstFocusableElement.focus()
    firstFocusableElement.blur()
  }
}

function main() {
  document.documentElement.classList.toggle('is-mobile', isMobile())

  const navToggler = document.getElementById('nav-toggler')
  const nonMainNavLinks = document.querySelectorAll(NON_MAIN_NAV_LINKS_SELECTORS.join(','))

  const { closeNav } = initMainNavigationMenu({
    navToggler,
    openDelay: SLIDE_ANIMATION_DURATION,
    onBeforeOpen: () => {
      animationTimeout(() => {
        const main = document.querySelector('[data-taxi]')
        main.classList.add('slide-out-right')
        animationTimeout(() => {
          main.classList.remove('slide-out-right')
        }, SLIDE_ANIMATION_DURATION + 100)
      }, LEAVE_PAGE_DELAY)
    },
    onOpen: () => {
      nonMainNavLinks.forEach((link) => {
        link?.setAttribute?.('tabindex', '-1')
      })
    },
    onClose: () => {
      nonMainNavLinks.forEach((link) => {
        link?.setAttribute?.('tabindex', '0')
      })
      document.documentElement.classList.add('closing-nav')
      animationTimeout(() => {
        document.documentElement.classList.remove('closing-nav')
      }, SLIDE_ANIMATION_DURATION)
    },
  })

  // if (!isMobile()) {
  const siteLogo = document.querySelector('.site-logo')
  const headerNavLinks = getHeaderNavlinks()
  const linksWithBackground = [siteLogo, navToggler, ...headerNavLinks, ...nonMainNavLinks]
  const palette = initLinksBackgrounds(linksWithBackground, COLORS)
  watchNewLinkBackgrounds(WATCH_LINKS_WITH_BACKGROUND_SELECTORS, palette)
  // }

  initCarousels()
  watchNewCarousels()

  observeIntersection(SCROLL_SELECTORS)

  initSmoothNav({
    ignore: SMOOTH_NAV_IGNORE,
    onPageLeave: () => {
      repositionModals()
      closeNav()
    },
    onPageEnter: () => {
      focusFirstElement()
      updateCurrentNavitem()
    },
  })
}
