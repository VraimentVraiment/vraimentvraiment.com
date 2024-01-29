<div>
  <?php echo Html::tag(
      'p',
      [
        Html::a(
            $href,
            [$label . Html::span('', ['class' => $iconClass])],
            $attrs
        )
      ],
  ); ?>
</div>
