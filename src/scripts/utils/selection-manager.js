export class SelectionManager {
  useIsotope = false
  Isotope = null
  isotope = null

  collection = []
  current = null
  onActivate = null
  onDeactivate = null

  constructor({
    items,
    useIsotope = false,
    containerSelector,
    itemSelector,
    isotopeOptions = {},
  }) {
    this.collection = [...items]
    if (useIsotope) {
      this.useIsotope = true
      this.isotopeOptions = isotopeOptions
    }
    this.containerSelector = containerSelector
    this.itemSelector = itemSelector
  }

  async loadIsotope() {
    this.Isotope ??= (await import('isotope-layout')).default
    this.isotope = new this.Isotope(this.containerSelector, {
      itemSelector: this.itemSelector,
      ...this.isotopeOptions,
    })
  }

  activate(item) {
    if (this.current?.classList.contains('active')) {
      this.deactivate(this.current)
    }
    item.classList.add('active')
    // item.setAttribute('aria-selected', 'true')
    this.current = item
    this.onActivate?.()
  }

  deactivate(item) {
    item.classList.remove('active')
    // item.setAttribute('aria-selected', 'false')
    this.onDeactivate?.()
  }

  deactivateAll() {
    this.collection.forEach((item) => {
      this.deactivate(item)
    })
  }

  getSibling(item, offset) {
    const index = this.collection.indexOf(item)
    return this.collection[(index + offset + this.collection.length) % this.collection.length]
  }

  get previous() {
    return this.getSibling(this.current, -1)
  }

  get next() {
    return this.getSibling(this.current, 1)
  }

  hide(items) {
    if (this.useIsotope) {
      this.isotope.hideItemElements(items)
    }
    else {
      items.forEach((item) => {
        item.classList.add('grid-hidden')
      })
    }
  }

  reveal(items) {
    if (this.useIsotope) {
      this.isotope.revealItemElements(items)
    }
    else {
      items.forEach((item) => {
        item?.classList.remove('grid-hidden')
      })
    }
  }
}
