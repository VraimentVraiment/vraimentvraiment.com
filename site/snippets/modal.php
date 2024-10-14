<div <?php echo $attrs ?>>
  <div class="modal__inner">
    <div class="modal-close-container">
      <a class="modal-close" href="<?php echo $closeHref ?>" aria-label="Fermer la modale">
        <div class="modal-close__icon"></div>
      </a>
    </div>
    <div class='modal-content'>
      <?php if ($modalContent = $slots->modalContent()) : ?>
        <?php echo $modalContent ?>
      <?php endif ?>
    </div>
  </div>
</div>