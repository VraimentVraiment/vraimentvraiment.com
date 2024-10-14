import { LEAVE_PAGE_DELAY, SLIDE_ANIMATION_DURATION } from '@/scripts/lib/constants'
import { animationTimeout } from '@/scripts/utils/animation-timeout'

import * as Taxi from '@unseenco/taxi'

function getTransition({
  onPageLeave,
  onPageEnter,
  direction = 'right',
} = {}) {
  return class extends Taxi.Transition {
    /**
     * Handle the transition leaving the previous page.
     * @param {{from: HTMLElement, trigger: string | HTMLElement | false, done: Function}} props
     */
    onLeave({ from, done }) {
      animationTimeout(() => {
        onPageLeave()
        from.classList.add(`slide-out-${direction}`)
        animationTimeout(() => {
          window.scrollTo({ top: 0 })
          animationTimeout(() => {
            done()
          })
        }, SLIDE_ANIMATION_DURATION)
      }, LEAVE_PAGE_DELAY)
    }

    /**
     * Handle the transition entering the next page.
     * @param {{to: HTMLElement, trigger: string | HTMLElement | false, done: Function}} props
     */
    onEnter({ done }) {
    // onEnter({ to, done }) {
      window.scrollTo({ top: 0 })
      onPageEnter()
      animationTimeout(() => {
        done()
      }, SLIDE_ANIMATION_DURATION)
    }
  }
}

export function initSmoothNav({
  ignore = [],
  onPageLeave = () => { },
  onPageEnter = () => { },
} = {}) {
  const ignoreSelectors = [
    '[target]',
    '[href^=\\#]',
    '[data-taxi-ignore]',
    ...ignore,
  ]
  const taxi = new Taxi.Core({
    links: `a${ignoreSelectors.map(s => `:not(${s})`).join('')}`,
    allowInterruption: true,
    // bypassCache: true,
    transitions: {
      default: getTransition({ onPageLeave, onPageEnter, direction: 'right' }),
    },
  })
  return taxi
}
