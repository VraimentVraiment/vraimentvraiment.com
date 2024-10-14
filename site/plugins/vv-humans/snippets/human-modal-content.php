<div class="human__cover">
  <?php echo $cover ?>
</div>
<div class="human__content">
  <div class="human__info">
    <div class="human__header">
      <p class="human__names">
        <span class="human__firstname">
          <?php echo $firstname ?>
        </span>
        <span class="human__name">
          <?php echo $name ?>
        </span>
      </p>
      <p class="human_profession">
        <span class='human__job'>
          <?php echo $job ?>
        </span>
        <span class='human__seniority'>
          <?php echo $seniority ?>
        </span>
      </p>
      <p class='human__seniority-details'>
        <?php echo $seniorityDetails ?>
      </p>
    </div>
    <div class="human__details">
      <?php if (count($skills) > 0) : ?>
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
  </div>
  <nav class="human__pagination">
    <div class="human__pagination-inner">
      <div class="human__previous">
        <a aria-label="Personne précédente">
          <span class="icon"></span>
          <span class="human__previous-label">Précédent·e</span>
        </a>
      </div>
      <div class="human__next">
        <a aria-label="Personne suivante">
          <span class="human__next-label">Suivant·e</span>
          <span class="icon"></span>
        </a>
      </div>
    </div>
  </nav>
</div>
