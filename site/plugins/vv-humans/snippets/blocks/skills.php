<div class="skills-container relative">
  <div class="md:absolute h-full left-0 top-O right-0 pb-8 pointer-events-none">
    <ul class="md:sticky md:top-32 flex flex-col items-start pointer-events-auto">
        <?php foreach (collection('expertises') as $skill) :?>
          <li class="first:mt-0 mt-4">
          <?php
          snippet('tag', [
            'label' => $skill->name(),
            'attrs' => [
              'class' => 'skill',
              'data-skill' => $skill->slug(),
            ],
          ]);
          ?>
          </li>
        <?php endforeach; ?>
    </ul>
  </div>
</div>
