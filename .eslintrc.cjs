/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution');

module.exports = {
  extends: [
    'airbnb-base',
    'plugin:import/recommended',
  ],
  env: {
    browser: true,
    es2021: true,
  },
  plugins: ['import'],
  settings: {
    'import/resolver': {
      alias: {
        map: [
          ['@', './src'],
          ['content', './content'],
        ],
      },
    },
  },
  overrides: [
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    // 'no-console': 'off',
    'no-plusplus': 'off',
    'import/no-extraneous-dependencies': ['off', { devDependencies: true }],
    'import/prefer-default-export': 'off',
  },
};
