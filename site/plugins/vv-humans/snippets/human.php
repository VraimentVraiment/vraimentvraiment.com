<li <?php
echo attr([
  'class' => 'human m-2 w-[calc(100%-1rem)] sm:w-[calc(calc(100%/2)-1rem)] md:w-[calc(calc(100%/3)-1rem)] lg:w-[calc(calc(100%/4)-1rem)]',
  'data-skills' => $human->expertises()->split(),
  'data-gender' => $human->gender(),
  'tabindex' => '0',
  'aria-label' => 'En savoir plus sur ' . $human->firstname() . ' ' . $human->name(),
  'aria-selected' => 'false',
  'aria-controls' => 'human-modal',
]);
?>>
  <div class="human__cover p-4px">
    <?php if ($human->cover()->isNotEmpty()) : ?>
      <?php $page->figure(
          $human->cover()->toFile()->focusCrop(400, 400),
          [
            "class" => "human-cover",
            "alt" => 'Portrait de ' . $human->firstname() . ' ' . $human->name(),
          ]
      );?>
    <?php endif; ?>
  </div>
  <div class="human__info pl-2 pr-4 py-1">
    <div>
      <p>
        <span class="human__info__firstname">
          <?php echo $human->firstname();?>
        </span>
        <span class="human__info__name">
          <?php echo $human->name();?>
        </span>
      </p>
      <p class="mt-1">
        <span class='human__info__job'>
          <?php echo $human->job();?>
        </span>
        <span class='human__info__seniority hidden'>
          <?php echo $page->getSeniorityLevel($human->seniority()->value(), $human->gender()->value());?>
        </span>
        <span class='human__info__seniority__details hidden'>
          <?php echo $page->getSeniorityLevelDetails($human->seniority()->value());?>
        </span>
      </p>
    </div>
    <div class="human__expand pt-2 pb-1 flex justify-end text-xl transform translate-x-2">
      <div class="icon i-ri-add-line"></div>
    </div>
  </div>
  <div class='human__details hidden'>
    <?php if ($human->skills()->isNotEmpty()) : ?>
    <hr class="w-8 mx-0 my-4 border-solid" />
    <p class="mb-2">Compétences</p>
    <ul class="human__details__skills list-initial pl-4">
      <?php foreach ($human->skills()->split() as $skill) :?>
        <?php if ($skill = $page->getSkill($skill)) : ?>
      <li class="human__details__skill mb-1 last:mb-0 text-sm">
          <?php echo $skill->name();?>
      </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</li>
