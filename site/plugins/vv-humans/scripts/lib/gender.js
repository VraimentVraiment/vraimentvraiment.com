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
}

function getHumanGender(item) {
  return item.querySelector('.human')?.dataset.gender || 'inclusive'
}

export function getPrevHumanBtnLabel(item) {
  return GENDER_MAP.PREV[getHumanGender(item)]
}

export function getNextHumanBtnLabel(item) {
  return GENDER_MAP.NEXT[getHumanGender(item)]
}
