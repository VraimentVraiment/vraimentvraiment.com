import Isotope from 'isotope-layout';

import { animationTimeout } from '@/scripts/lib/animation-timeout';
import { BREAKPOINTS } from '@/scripts/lib/constants';

const TRANSITION_DURATION = 600;

const DUPLICATE_SELECTORS = [
  '.human__cover',
  '.human__info__firstname',
  '.human__info__name',
  '.human__info__job',
  '.human__info__seniority',
  '.human__info__seniority__details',
  '.human__details',
];

const GENDER_MAP = {
  NEXT: {
    male: 'Suivant',
    female: 'Suivante',
    inclusive: 'Suivant·e',
  },
  PREV: {
    male: 'Précédent',
    female: 'Précédente',
    inclusive: 'Précédent·e',
  },
};

window.addEventListener('load', () => {
  const skillsContainer = document.querySelector('.skills-container');
  const skillsEls = skillsContainer.querySelectorAll('.skill');
  const humansContainer = document.querySelector('.humans-container');
  const humansEls = document.querySelectorAll('.human');
  const modalEl = document.getElementById('human-modal');
  const modalHiderEl = document.querySelector('.modal-hider');
  const headerEl = document.querySelector('.site-header');

  const closeBtn = modalEl.querySelector('.modal-close');
  const previousBtn = modalEl.querySelector('.human__pagination__previous');
  const nextBtn = modalEl.querySelector('.human__pagination__next');
  const previousBtnLabel = previousBtn.querySelector('.human__pagination__previous__label');
  const nextBtnLabel = nextBtn.querySelector('.human__pagination__next__label');
  const modal = {

    open(callback) {
      if (modalEl.style.display !== 'block') {
        modalEl.style.display = 'block';
        modalHiderEl.style.display = 'block';
        document.body.style.overflow = 'hidden';
        modalEl.focus();
      }
      modalEl.classList.add('enter');
      callback?.();
      animationTimeout(() => {
        modalEl.classList.remove('enter');
      }, TRANSITION_DURATION);
    },

    close(callback) {
      modalEl.style.display = 'none';
      modalHiderEl.style.display = 'none';
      document.body.style.overflow = 'auto';
      callback?.();
    },
  };

  /**
   * Initialize Isotope
   */
  const isotope = new Isotope(humansContainer, {
    itemSelector: '.human',
    layoutMode: 'fitRows',
    hiddenStyle: {
      opacity: 0.001,
      transform: 'translatex(2rem)',
    },
    visibleStyle: {
      opacity: 1,
      transform: 'translatex(0)',
    },
  });

  /**
   * Set the skills container's height to match humans container's height
   * This is necessary because the skills container has 'position: sticky'
   * and needs to have a fixed height
   */
  const setSkillsContainerHeight = () => {
    if (window.innerWidth > BREAKPOINTS.MD) {
      skillsContainer.style.height = `${humansContainer.clientHeight}px`;
    } else {
      skillsContainer.style.height = 'auto';
      // skillsContainer.style.height = '100vh';
    }
  };
  setSkillsContainerHeight();
  window.addEventListener('resize', setSkillsContainerHeight); // we could use a throttle here

  const tags = {
    activeTags: [],

    activateTag(tag) {
      tag.classList.add('active');
      this.activeTags.push(tag.dataset.skill);
      /**
       * remove other active tags
       */
      skillsEls.forEach((otherTag) => {
        if (otherTag !== tag && otherTag.classList.contains('active')) {
          otherTag.classList.remove('active');
          this.activeTags.splice(this.activeTags.indexOf(otherTag.dataset.skill), 1);
        }
      });
    },

    desactivateTag(tag) {
      this.activeTags.splice(this.activeTags.indexOf(tag), 1);
      tag.classList.remove('active');
    },
  };

  const humans = {
    currentHuman: null,

    filter(activeTags) {
      this.desactivateAll();
      /**
       * Filter humans based on active tags
       */
      isotope.arrange({
        filter(humanEl) {
          const humanSkills = humanEl.dataset.skills?.split(' ') || [];
          return activeTags.every((skill) => humanSkills.includes(skill));
        },
      });

      /**
       * Scroll humans container to its top
       */
      window.scrollTo({
        top: humansContainer.offsetTop - headerEl.clientHeight,
        behavior: 'smooth',
      });

      animationTimeout(() => {
        setSkillsContainerHeight();
      }, TRANSITION_DURATION);
    },

    activateHuman(human) {
      if (this.currentHuman?.classList.contains('active')) {
        this.desactivateHuman(this.currentHuman);
      }
      human.classList.add('active');
      human.setAttribute('aria-selected', 'true');
      this.currentHuman = human;
      isotope.hideItemElements([human]);
      DUPLICATE_SELECTORS.forEach((selector) => {
        const el = modalEl.querySelector(selector);
        el.innerHTML = human.querySelector(selector)?.innerHTML;
      });
      this.setHumanSiblingsGenders(human);
    },

    desactivateHuman(human) {
      human.classList.remove('active');
      human.setAttribute('aria-selected', 'false');
      isotope.revealItemElements([human]);
    },

    desactivateAll() {
      document.querySelectorAll('.human.active')
        .forEach(humans.desactivateHuman);
    },

    getSiblingHuman(human, offset) {
      const items = isotope.getFilteredItemElements();
      const humanIndex = Array.from(items).indexOf(human);
      return items[(humanIndex + offset + items.length) % items.length];
    },

    setPrevHuman() {
      const prevHuman = this.getSiblingHuman(this.currentHuman, -1);
      if (prevHuman) {
        this.activateHuman(prevHuman);
      }
    },

    setNextHuman() {
      const nextHuman = this.getSiblingHuman(this.currentHuman, 1);
      if (nextHuman) {
        this.activateHuman(nextHuman);
      }
    },

    setHumanSiblingsGenders(human) {
      const previousHuman = this.getSiblingHuman(human, -1);
      const previousHumanGender = previousHuman?.dataset.gender || 'inclusive';

      const nextHuman = this.getSiblingHuman(human, 1);
      const nextHumanGender = nextHuman?.dataset.gender || 'inclusive';

      previousBtnLabel.innerHTML = GENDER_MAP.PREV[previousHumanGender];
      nextBtnLabel.innerHTML = GENDER_MAP.NEXT[nextHumanGender];
    },
  };

  /**
   * Tag click events
   */
  skillsEls.forEach((tag) => {
    tag.addEventListener('click', () => {
      if (!tag.classList.contains('active')) {
        tags.activateTag(tag);
      } else {
        tags.desactivateTag(tag);
      }
      humans.filter(tags.activeTags);
    });
  });

  /**
   * Open modal events
   */
  humansEls.forEach((human) => {
    human.addEventListener('click', () => {
      modal.open(() => humans.activateHuman(human));
    });
    human.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        modal.open(() => humans.activateHuman(human));
      }
    });
  });

  /**
   * Set siblings events
   */
  previousBtn?.addEventListener('click', () => {
    humans.setPrevHuman();
  });
  nextBtn?.addEventListener('click', () => {
    humans.setNextHuman();
  });
  previousBtn?.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      humans.setPrevHuman();
    }
  });
  nextBtn?.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      humans.setNextHuman();
    }
  });

  /**
   * Close modal events
   */
  closeBtn.addEventListener('click', () => {
    modal.close(() => humans.desactivateAll());
  });
  modalHiderEl.addEventListener('click', () => {
    modal.close(() => humans.desactivateAll());
  });
});
