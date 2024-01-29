<p <?php echo attr($block->attrs());?>>
    <?php echo $block->prefix();?>
    <?php echo Html::a(
        $block->href(),
        [$block->text() . $block->icon()],
        $block->linkAttrs()
    ); ?>
    <?php echo $block->suffix();?>
</p>
