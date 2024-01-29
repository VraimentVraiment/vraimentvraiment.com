import {
  defineConfig,
  presetIcons,
  presetTypography,
  presetWind,
} from 'unocss';

export default defineConfig({

  shortcuts: [
    [/^vv-site-margin-x:(.*)$/, ([, r]) => `${r}-4 sm:${r}-8 md:${r}-12 lg:${r}-16 xl:${r}-[calc(50%-32rem)] xxl:${r}-[calc(50%-36rem)]`],
  ],

  theme: {
    breakpoints: {
      sm: '375px',
      md: '767px',
      lg: '991px',
      xl: '1447px',
      xxl: '1920px',
    },
  },

  presets: [
    presetWind(),
    presetIcons({
      extraProperties: {
        display: 'inline-block',
        'white-space': 'nowrap',
        'vertical-align': 'sub',
      },
    }),
    presetTypography(),
  ],

  safelist: [
    'inline',
    'i-ri-mail-line',
    'i-ri-phone-line',
    'i-ri-map-pin-2-line',
    'i-ri-arrow-right-line',
    'i-ri-external-link-line',
    'i-ri-twitter-fill',
    'i-ri-instagram-fill',
    'i-ri-linkedin-box-fill',
    'col-span-1',
    'col-span-2',
    'col-span-3',
    'col-span-4',
    'col-span-5',
    'col-span-6',
    'md:col-span-1',
    'md:col-span-2',
    'md:col-span-3',
    'md:col-span-4',
    'md:col-span-5',
    'md:col-span-6',
  ],
});
