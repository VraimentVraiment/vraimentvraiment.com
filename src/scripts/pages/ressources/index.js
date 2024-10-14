import { observeAddedNodes } from '@/scripts/utils/observe-added-nodes'
import { initResources } from '@plugins/vv-resources/scripts/'

window.addEventListener('DOMContentLoaded', main)

const CONTENT_ROUTE = `/ressources.json`

const USE_ISOTOPE = false
// const USE_ISOTOPE = true
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

async function main() {
  initResources({
    contentRoute: CONTENT_ROUTE,
    isotopeOptions: ISOTOPE_OPTIONS,
    useIsotope: USE_ISOTOPE,
  })
  observeAddedNodes('.resources', () => {
    initResources({
      contentRoute: CONTENT_ROUTE,
      isotopeOptions: ISOTOPE_OPTIONS,
      useIsotope: USE_ISOTOPE,
    })
  })
}
