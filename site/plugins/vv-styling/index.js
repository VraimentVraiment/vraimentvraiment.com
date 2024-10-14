// eslint-disable-next-line no-undef
panel.plugin('vv/styling', {
  blocks: {
    text: {
      computed: {
        component() {
          const component = `k-${this.textField.type}-input`

          if (this.$helper.isComponent(component)) {
            return component
          }

          // fallback to writer
          return 'k-writer-input'
        },
        isSplitable() {
          return (
            this.content.text.length > 0
            && this.input().isCursorAtStart === false
            && this.input().isCursorAtEnd === false
          )
        },
        keys() {
          const keys = {
            'Mod-Enter': this.split,
          }

          if (this.textField.inline === true) {
            keys.Enter = this.split
          }

          return keys
        },
        textField() {
          return this.field('text', {})
        },
        sizeClass() {
          return {
            [`text-${this.content.size}`]: this.content.size,
          }
        },
        alignStyle() {
          return {
            textAlign: this.content.align,
          }
        },
      },
      methods: {
        focus() {
          this.$refs.input.focus()
        },
        input() {
          return this.$refs.input.$refs.input
        },
        merge(blocks) {
          this.update({
            text: blocks
              .map(block => block.content.text)
              .join(this.textField.inline ? ' ' : ''),
          })
        },
        split() {
          const contents = this.input().getSplitContent?.()

          if (contents) {
            if (this.textField.type === 'writer') {
              contents[0] = contents[0].replace(/(<p><\/p>)$/, '')
              contents[1] = contents[1].replace(/^(<p><\/p>)/, '')
            }

            this.$emit(
              'split',
              contents.map(content => ({ text: content })),
            )
          }
        },
      },
      template: `
        <div :class="sizeClass" :style="alignStyle">
          <component
            :is="component"
            ref="input"
            v-bind="textField"
            :disabled="disabled"
            :keys="keys"
            :value="content.text"
            class="k-block-type-text-input"
            @input="update({ text: $event })"
          />
        </div>
      `,
    },

    spacing: `
      <div class="spacing-block" @dblclick="open">
        <div class="wrapper">
          <div
            v-if="content.size !== 'none'"
            class="line"
            :class="['size--' + content.size]"
          >
            <span class="arrow up"></span>
            <span class="line__inner"></span>
            <span class="arrow down"></span>
            <span class="size-label">{{ content.size }}</span>
          </div>
          <div v-else>
            <k-icon type="hidden">
          </div>
          <div class="text">
            Espacement par défaut
          </div>
        </div>
        <div class="wrapper" v-if="content.mobile_size">
          <div
            v-if="content.mobile_size !== 'none'"
            class="line line--mobile"
            :class="['size--' + content.mobile_size]"
          >
            <span class="arrow up"></span>
            <span class="line__inner"></span>
            <span class="arrow down"></span>
            <span class="size-label">{{ content.mobile_size }}</span>
          </div>
          <div v-else>
            <k-icon type="hidden">
          </div>          
          <div class="text">
            Espacement mobile
          </div>
        </div>
      </div>
    `,
  },
})
