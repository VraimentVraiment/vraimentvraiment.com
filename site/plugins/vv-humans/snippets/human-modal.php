<?php
snippet('modal', [
  'id' => 'human-modal',
  'open' => $open,
  'closeHref' => $closeHref,
], slots: true);
?>
<?php slot('modalContent'); ?>
<?php if ($open) : ?>
  <?php snippet('human-modal-content', compact('human', 'page')); ?>
<?php else : ?>
  <div class="human__cover"></div>
  <div class="human__content"></div>
<?php endif; ?>
<?php endslot(); ?>
<?php endsnippet();
