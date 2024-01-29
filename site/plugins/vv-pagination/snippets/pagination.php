<nav <?php echo attr(
    A::extend(
        [
          'class' => "pagination flex justify-between items-center py-4 px-1 mt-2"
        ],
        $attrs ?? []
    ),
); ?>>
    <?php if ($hasPrev ?? false) : ?>
      <?php
      snippet('pagination-item', [
        'label' => $prevLabel,
        'iconClass' => 'i-ri-arrow-left-line mr-1',
        'href' => $prev->url(),
        'attrs' => [
          'class' => 'pagination-item prev flex justify-center items-center flex-row-reverse',
        ],
      ]);
      ?>
    <?php else : ?>
      <div></div>
    <?php endif; ?>
    <?php if ($hasNext ?? false) : ?>
      <?php
      snippet('pagination-item', [
        'label' => $nextLabel,
        'iconClass' => 'i-ri-arrow-right-line ml-1',
        'href' => $next->url(),
        'attrs' => [
          'class' => 'pagination-item next flex justify-center items-center',
        ]
      ]);
      ?>
    <?php else : ?>
      <div></div>
    <?php endif; ?>
</nav>
