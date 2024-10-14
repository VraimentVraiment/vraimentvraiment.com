export function observeIntersection(selectors) {
  const direction = useGetScrollDirection()
  const observe = () => observeElementsIntersection(direction, selectors)
  observe()
  window.addEventListener('scroll', observe, false)
}

function observeElementsIntersection(direction, selectors) {
  /** @todo I don't really understand how rootMargin works */
  const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0)
  const top = direction.is === 'up' ? -0.15 * vh : -0.15 * vh
  const bottom = direction.is === 'down' ? -0.15 * vh : -0.15 * vh
  const rootMargin = `${top}px 0px ${bottom}px 0px`
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      entry.target.classList.add('intersection-observer')
      if (entry.isIntersecting) {
        entry.target.classList.add('once-in-view')
      }
    })
  }, {
    rootMargin,
  })

  const elements = document.querySelectorAll(selectors.join(','))
  elements.forEach(element => observer.observe(element))
}

function useGetScrollDirection() {
  let lastScrollTop = 0
  const direction = { is: 'down' }
  window.addEventListener('scroll', setScrollDirection, false)

  function setScrollDirection() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop
    if (scrollTop > lastScrollTop) {
      document.body.classList.add('scroll-down')
      document.body.classList.remove('scroll-up')
      direction.is = 'down'
    }
    else {
      document.body.classList.add('scroll-up')
      document.body.classList.remove('scroll-down')
      direction.is = 'up'
    }
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop
  }
  return direction
}
