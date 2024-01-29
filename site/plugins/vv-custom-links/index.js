panel.plugin('vv/custom-link', {
  blocks: {
    'custom-link': {
      template: `
      <p
        :class="content.type" 
        @click="open"
      >
      <span class="prefix">
        {{ content.prefix }}
      </span>
      <span class="text">
        {{ content.text }}
      </span>
      <span class="suffix">
        {{ content.suffix }}
      </span>
      </p>
    `,
    },
  },
});
