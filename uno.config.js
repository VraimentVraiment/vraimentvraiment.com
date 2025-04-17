import transformerDirectives from '@unocss/transformer-directives'

import {
  defineConfig,
  presetIcons,
  presetTypography,
  presetWind,
} from 'unocss'

const colors = {
  black: '#333',
  white: '#fbfaf9',
  blackLight: '#666',
  blackLightest: '#ddd',
}

const tokens = {
  'bg': colors.white,
  'font': colors.black,
  'font-light': colors.blackLight,
  'border': colors.blackLightest,
}

export default defineConfig({

  theme: {
    breakpoints: {
      sm: '375px',
      smd: '575px',
      md: '767px',
      lg: '991px',
      xl: '1447px',
      xxl: '1920px',
    },
    colors: {
      ...colors,
      ...tokens,
    },
  },

  presets: [
    presetWind(),
    presetIcons({
      extraProperties: {
        'display': 'inline-block',
        'white-space': 'nowrap',
        'vertical-align': 'sub',
      },
    }),
    presetTypography(),
  ],

  transformers: [
    transformerDirectives(),
  ],

  safelist: [
    'i-ri-close-fill',
    'i-ri-mail-line',
    'i-ri-phone-line',
    'i-ri-map-pin-2-line',
    'i-ri-arrow-right-line',
    'i-ri-external-link-line',
    'i-ri-twitter-fill',
    'i-ri-instagram-fill',
    'i-ri-linkedin-box-fill',
    'i-ri-github-fill',
    'i-ri-bluesky-fill',
    'items-center',
  ],
})
