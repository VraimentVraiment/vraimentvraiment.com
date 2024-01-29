<div class="layout w-full">
  <?php foreach ($layouts as $layout) : ?>
  <section
    <?php
    echo attr([
      'class' => A::join([
        'row mt-12 md:mt-8 first:mt-0 grid grid-cols-6 gap-12 md:gap-20',
        $layout->class()
      ], ' '),
    ]);
    ?>>
    <?php foreach ($layout->columns() as $column) : ?>
    <div
      <?php
      echo attr([
        'class' => A::join([
          'column col-span-6',
          ('md:col-span-' . $column->span(6))
        ], ' '),
      ]);
      ?>>
      <?php foreach ($column->blocks() as $block) : ?>
        <div
        <?php
        echo attr([
          'class' => A::join([
            'k-block mt-4 first:mt-0',
            $block->class()
          ], ' '),
        ]);
        ?>>
        <?php echo $block;?>
        </div>
      <?php endforeach;?>
    </div>
    <?php endforeach;?>
  </section>
  <?php endforeach;?>
</div>
