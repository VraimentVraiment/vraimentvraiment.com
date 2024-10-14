// import Bowser from 'bowser'

export function isMobile() {
  // const parser = Bowser.getParser(navigator.userAgent)
  // return parser.getPlatformType() === 'mobile'
  return window.innerWidth < 768
}
