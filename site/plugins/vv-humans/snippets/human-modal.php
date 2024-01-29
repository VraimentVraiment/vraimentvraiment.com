<?php

?>

<div class="modal-hider hidden fixed z-998 top-0 left-0 right-0 bottom-0 bg-black opacity-20"></div>
<div <?php
echo attr([
  'id' => 'human-modal',
  'role' => 'dialog',
  'aria-modal' => 'true',
  'tabindex' => '0',
  'class' => 'modal hidden fixed z-999 h-[calc(100vh-8rem)] max-h-160 md:max-h-none md:h-[calc(100vh-4rem)] lg:h-[calc(100vh-2rem)] transform bottom-8 md:bottom-auto md:top-50% md:translate-y--50% right-50% md:right-12 lg:right-16 xl:$right-[calc(50%-32rem)] xxl:right-[calc(50%-36rem)]`] translate-x-50% md:translate-x-0 outline-none border-solid m-0 ml-auto px-4 pt-4'
]); ?>>
  <div class="modal-close-container absolute z-10 right-1px top-1px p-1">
    <button class="modal-close cursor-pointer p-1">
      <div class="i-ri-close-line text-xl"></div>
    </button>
  </div>
  <div class='relative h-full w-64 sm:w-72 lg:w-80'>
    <div class="human__cover h-64 sm:h-72 lg:h-80"></div>
    <div class="human__content h-[calc(100vh-27.4rem)] overflow-auto mt-4 pb-4">
      <div>
        <p class="lh-[1.1]">
          <span class="human__info__firstname"></span>
          <span class="human__info__name"></span>
        </p>
        <p class="mt-4 mb-0 lh-[1.1]">
          <span class='human__info__job'></span>
          <span class='human__info__seniority'></span>
        </p>
        <p class='human__info__seniority__details text-sm mt-2'></p>
      </div>
      <div class="human__details mb-20 md:mb-0">
      </div>
      <nav class="human__pagination absolute bottom-0 left-0 right-0 flex align-center justify-between border-t-solid py-4">
        <div class="human__pagination__previous z-10">
          <p class="link text-sm" tabindex="0">
            <span class="icon i-ri-arrow-left-line"></span>
            <span class="human__pagination__previous__label">Précédent</span>
          </p>
        </div>
        <div class="human__pagination__next z-10">
          <p class="link text-sm" tabindex="0">
            <span class="human__pagination__next__label">Suivant</span>
            <span class="icon i-ri-arrow-right-line"></span>
          </p>
        </div>
      </nav>
    </div>
  </div>
</div>
