window.panel.plugin('vv/layouts', {
  blocks: {
    nestedlayout: `
      <div
        class="k-block-type-nestedlayout"
        @dblclick="open"
      >
        <k-layout-field
          :value="content.layout"
          v-bind="this.field('layout')"
          label="Disposition"
          @input="update"
        />
      </div>
      `,
  },
});
