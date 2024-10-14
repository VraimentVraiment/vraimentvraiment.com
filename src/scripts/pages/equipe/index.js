import { observeAddedNodes } from '@/scripts/utils/observe-added-nodes'
import { initHumans } from '@plugins/vv-humans/scripts/'

// const USE_ISOTOPE = true
const USE_ISOTOPE = false

const ISOTOPE_OPTIONS = {
  layoutMode: 'fitRows',
  transitionDuration: '0.3s',
  hiddenStyle: {
    opacity: 0.001,
    transform: 'translatex(1rem)',
  },
  visibleStyle: {
    opacity: 1,
    transform: 'translatex(0)',
  },
}

window.addEventListener('DOMContentLoaded', main)

async function main() {
  initHumans({
    isotopeOptions: ISOTOPE_OPTIONS,
    useIsotope: USE_ISOTOPE,
  })
  observeAddedNodes('.humans-container', () => {
    initHumans({
      isotopeOptions: ISOTOPE_OPTIONS,
      useIsotope: USE_ISOTOPE,
    })
  })
}
