import path from 'path';
import { glob } from 'glob';

import eslint from 'vite-plugin-eslint';
import stylelint from 'vite-plugin-stylelint';
import kirby from 'vite-plugin-kirby';
import UnoCSS from 'unocss/vite';

import postcssCombineMediaQuery from 'postcss-combine-media-query';
import postcssCombineDuplicatedSelectors from 'postcss-combine-duplicated-selectors';

const projectDir = path.dirname(new URL(import.meta.url).pathname);
const srcDir = path.resolve(projectDir, 'src');
const outDir = path.resolve(projectDir, 'www/assets');
const buildAssetsDir = '.';

export default ({ mode }) => ({

  base: mode === 'development' ? '/' : '/assets/',

  root: srcDir,

  resolve: {
    alias: [
      {
        find: '@',
        replacement: srcDir,
      },
    ],
  },

  build: {
    outDir,
    assetsDir: buildAssetsDir,
    rollupOptions: {
      input: [
        path.resolve(srcDir, 'vite.entry.js'),
        ...glob.sync(path.resolve(srcDir, 'scripts/pages/**/*.js')),
      ],
    },
  },

  css: {
    postcss: {
      plugins: [
        postcssCombineMediaQuery,
        postcssCombineDuplicatedSelectors,
      ],
    },
  },

  plugins: [
    kirby({
      watch: [
        '../site/**/(templates|snippets|controllers|models|layouts)/**/*.php',
        '../content/**/*',
      ],
    }),
    UnoCSS(),
    stylelint(),
    {
      apply: 'build',
      ...eslint(),
    },
    {
      apply: 'serve',
      ...eslint({
        failOnWarning: false,
        failOnError: false,
      }),
      enforce: 'post',
    },
  ],
});
