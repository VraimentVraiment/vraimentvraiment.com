import { animationTimeout } from '@/scripts/utils/animation-timeout'

export class Modal {
  modalEl = null
  enterDelay = 0
  closeDelay
  modalHiderEl = null
  onClose = null

  constructor({ modalEl, enterDelay = 0, closeDelay = 0 }) {
    this.modalEl = modalEl
    this.enterDelay = enterDelay
    this.closeDelay = closeDelay
    this.modalHiderEl = document.getElementById('modal-hider')
    const parent = document.body
    // const parent = document.querySelector('main')
    if (!this.modalHiderEl) {
      this.modalHiderEl = document.createElement('div')
      this.modalHiderEl.id = 'modal-hider'
    }
    parent.appendChild(this.modalHiderEl)
    parent.appendChild(this.modalEl)
    this.modalHiderEl.addEventListener('click', () => {
      this.close()
    })
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        this.close()
      }
    })
  }

  setLinkTabIndexes() {
    this.modalEl.querySelectorAll('a, button').forEach((el) => {
      el.setAttribute('tabindex', '0')
    })
  }

  open(callback) {
    if (this.modalEl.style.display !== 'block') {
      this.modalEl.style.display = 'block'
      this.modalHiderEl.classList.add('shown')
      document.documentElement.classList.add('modal-open')
      this.modalEl.focus()
    }
    if (this.enterDelay > 0) {
      this.modalEl.classList.add('enter')
      callback?.()
      animationTimeout(() => {
        this.setLinkTabIndexes()
        this.modalEl.classList.remove('enter')
      }, this.enterDelay)
    }
    else {
      callback?.()
    }
  }

  close() {
    if (this.closeDelay > 0) {
      this.modalEl.classList.add('leave')
      this.modalHiderEl.classList.remove('shown')
      animationTimeout(() => {
        this.modalEl.style.display = 'none'
        document.documentElement.classList.remove('modal-open')
        this.onClose?.()
        this.modalEl.classList.remove('leave')
      }, this.closeDelay)
    }
    else {
      this.modalEl.style.display = 'none'
      document.documentElement.classList.remove('modal-open')
      this.onClose?.()
    }
  }
}
