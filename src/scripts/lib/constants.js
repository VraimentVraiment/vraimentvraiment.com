import { isMobile } from '@/scripts/utils/detect-mobile'

export const COLORS = [
  '#ff4040',
  '#1cbb59',
  '#1fafff',
  '#4e26f7',
  '#f27ed5',
  '#ff9640',
  '#ffba03',
]

export const SLIDE_ANIMATION_DURATION = isMobile() ? 250 : 300
export const LINK_ANIMATION_DURATION = isMobile() ? 250 : 300
export const LEAVE_PAGE_DELAY = isMobile() ? 300 : 0
