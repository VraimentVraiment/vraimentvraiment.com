<div <?php echo $attrs ?>>
  <a <?php echo $innerAttrs ?>>
    <div class="human__cover" data-tomodal=".human__cover">
      <?php echo $cover ?>
    </div>
    <div class="human__info">
      <div class="human__header">
        <p class="human__names">
          <span class="human__firstname" data-tomodal=".human__firstname">
            <?php echo $firstname ?>
          </span>
          <span class="human__name" data-tomodal=".human__name">
            <?php echo $name ?>
          </span>
        </p>
        <p class="human_profession">
          <span class='human__job' data-tomodal=".human__job">
            <?php echo $job ?>
          </span>
          <span class='human__seniority' data-tomodal=".human__seniority">
            <?php echo $seniority ?>
          </span>
          <span class='human__seniority-details' data-tomodal=".human__seniority-details">
            <?php echo $seniorityDetails ?>
          </span>
        </p>
      </div>
      <div class="human__expand">
        <div class="human__expand-icon"></div>
      </div>
    </div>
    <div class='human__details' data-tomodal=".human__details">
      <?php if ($skills) : ?>
      <p class="human__details-title">Compétences</p>
      <ul class="human__skills">
        <?php foreach ($skills as $skillName) :?>
        <li class="human__skill">
          <?php echo $skillName ?>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
  </a>
</div>
