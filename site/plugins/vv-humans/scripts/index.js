import { LEAVE_PAGE_DELAY, SLIDE_ANIMATION_DURATION } from '@/scripts/lib/constants'
import { animationTimeout } from '@/scripts/utils/animation-timeout'
import { Modal } from '@/scripts/utils/modal'
import { SelectionManager } from '@/scripts/utils/selection-manager'

import { getNextHumanBtnLabel, getPrevHumanBtnLabel } from './lib/gender'

export async function initHumans({
  isotopeOptions = {},
  useIsotope = false,
}) {
  const containerSelector = '.humans-container'
  const itemSelector = '.human-card'

  /**
   * Select dom elements
   */
  const items = document.querySelectorAll(itemSelector)
  const container = document.querySelector(containerSelector)

  if (!container || !items.length) {
    return
  }

  const modalEl = document.getElementById('human-modal')
  const closeModalBtn = modalEl.querySelector('.modal-close')
  /**
   * Initialize classes
   */
  const modal = new Modal({
    modalEl,
    enterDelay: SLIDE_ANIMATION_DURATION,
    closeDelay: SLIDE_ANIMATION_DURATION,
  })

  // const humans = new SelectionManager(items)
  const humans = new SelectionManager({
    items,
    useIsotope,
    containerSelector,
    itemSelector,
    isotopeOptions,
  })
  if (useIsotope) {
    await humans.loadIsotope()
  }

  async function replaceHumanModalContent(human) {
    const modalContentEl = document.querySelector('.modal-content')
    const slug = human.querySelector('.human').dataset.slug
    const response = await fetch(`/equipe/${slug}.json`)
    const json = await response.json()
    if (json.modalContent) {
      if (modalContentEl) {
        modalContentEl.innerHTML = json.modalContent
        handleSiblingSelection()
        modalEl.focus()
        modal.setLinkTabIndexes()
      }
    }
  }

  /**
   * Bind modal, humans list and isotope events together
   */
  humans.onActivate = () => {
    /** When modal is open, hide current human from grid layout */
    humans.hide([humans.current])

    replaceHumanModalContent(humans.current)
  }

  /** When modal is closed, reveal current human in grid layout */
  humans.onDeactivate = () => {
    humans.reveal([humans.current])
  }

  /**
   * Listen modal opening events
   */
  items.forEach((item) => {
    const link = item.querySelector('a')
    link.addEventListener('click', (e) => {
      e.preventDefault()
      e.stopPropagation()
      animationTimeout(() => {
        modal.open(() => {
          humans.activate(item)
        })
      }, LEAVE_PAGE_DELAY)
    })
    link.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault()
        e.stopPropagation()
        modal.open(() => {
          humans.activate(item)
        })
      }
    })
  })
  /**
   * Listen modal closing events
   */
  closeModalBtn.addEventListener('click', (e) => {
    e.preventDefault()
    // e.stopPropagation()
    animationTimeout(() => {
      modal.close()
    }, LEAVE_PAGE_DELAY)
  })
  /** Whenever modal is closed, make sure to deactivate all humans */
  modal.onClose = () => {
    const link = humans.current.querySelector('a')
    link.focus()
    link.blur()
    humans.deactivateAll()
  }

  /**
   * Listen sibling selection events
   */
  handleSiblingSelection()
  function handleSiblingSelection() {
    const previousBtn = modalEl.querySelector('.human__previous')
    const nextBtn = modalEl.querySelector('.human__next')
    const previousBtnLabel = previousBtn?.querySelector('.human__previous-label')
    const nextBtnLabel = nextBtn?.querySelector('.human__next-label')

    /** Update pagination buttons label based on current siblings gender */
    if (previousBtnLabel) {
      previousBtnLabel.innerHTML = getPrevHumanBtnLabel(humans.previous)
    }
    if (nextBtnLabel) {
      nextBtnLabel.innerHTML = getNextHumanBtnLabel(humans.next)
    }

    const PAUSE_DURATION = 20
    const ANIMATE = false

    const setPrevHuman = () => {
      animationTimeout(() => {
        if (ANIMATE) {
          const modalContentEl = document.querySelector('.modal-content')
          modalContentEl.classList.add('slide-out-right')
          animationTimeout(() => {
            modalContentEl.style.opacity = 0
            modalContentEl.classList.remove('slide-out-right')
            humans.activate(humans.previous)
            animationTimeout(() => {
              modalContentEl.style.opacity = 1
              modalContentEl.classList.add('slide-in-right')
              animationTimeout(() => {
                modalContentEl.classList.remove('slide-in-right')
              }, SLIDE_ANIMATION_DURATION)
            }, PAUSE_DURATION)
          }, SLIDE_ANIMATION_DURATION)
        }
        else {
          humans.activate(humans.previous)
        }
      }, LEAVE_PAGE_DELAY)
    }
    const setNextHuman = () => {
      animationTimeout(() => {
        if (ANIMATE) {
          const modalContentEl = document.querySelector('.modal-content')
          modalContentEl.classList.add('slide-out-left')
          animationTimeout(() => {
            modalContentEl.style.opacity = 0
            modalContentEl.classList.remove('slide-out-left')
            humans.activate(humans.next)
            animationTimeout(() => {
              modalContentEl.style.opacity = 1
              modalContentEl.classList.add('slide-in-left')
              animationTimeout(() => {
                modalContentEl.classList.remove('slide-in-left')
              }, SLIDE_ANIMATION_DURATION)
            }, PAUSE_DURATION)
          }, SLIDE_ANIMATION_DURATION)
        }
        else {
          humans.activate(humans.next)
        }
      }, LEAVE_PAGE_DELAY)
    }
    previousBtn?.addEventListener('click', setPrevHuman)
    nextBtn?.addEventListener('click', setNextHuman)
    previousBtn?.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        setPrevHuman()
      }
    })
    nextBtn?.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        setNextHuman()
      }
    })
  }
}
