panel.plugin('vv/icons', {
  blocks: {
    icon: {
      template: `
      <p
        v-if="content.icon && content.icon.length > 0"
        class="icon-info" 
      > 
        <span class="info">
          Icône
        </span>
        <span class="text">
          {{ content.icon[0].id }}
        </span>
        <span class="image">
          <img :src="content.icon[0].url"/>
        </span>
      </p>
    `,
    },
  },
});
