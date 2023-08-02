<?php require_once __DIR__ . "/props.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Design 3 | Resume Template</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/resumes/design/<?= $css_file ?>">
</head>

<body>
  <article id="template_main">
    <header class="flex column">
      <h1><?= get($personal, 'firstname') . ' ' . get($personal, 'lastname') ?></h1>
      <h3><?= get($personal, 'headline') ?></h3>
      <div class="dash"></div>
    </header>
    <div class="content">
      <div class="layer side">
        <ul class="personal">
          <li class="flex mb-x gap-1 start top <?= get($personal, 'phone') ? '' : 'section_hide' ?>">
            <span class="on-icon flex"><?= getIcon("phone") ?></span>
            <div class="text"><?= get($personal, 'phone') ?></div>
          </li>
          <li class="flex mb-x gap-1 start top <?= get($personal, 'email') ? '' : 'section_hide' ?>">
            <span class="on-icon flex"><?= getIcon("email") ?></span>
            <div class="text"><?= get($personal, 'email') ?></div>
          </li>
          <li class="flex mb-x gap-1 start top <?= get($personal, 'address') ? '' : 'section_hide' ?>">
            <span class="on-icon flex"><?= getIcon("address") ?></span>
            <div class="text"><?= get($personal, 'address') ?></div>
          </li>
          <li class="flex mb-x gap-1 start top <?= get($personal, 'date_of_birth') ? '' : 'section_hide' ?>">
            <span class="on-icon flex"><?= getIcon("date") ?></span>
            <div class="text"><?= get($personal, 'date_of_birth') ?></div>
          </li>

          <?php
          if (!empty($extras)) :
            echo '<div class="extras"></div>';
            foreach ($extras as $key => $data) { ?>
          <li class="flex mb-1 gap-1 start">
            <span class="on-icon flex"><?= getIcon($key) ?></span>
            <div class="text"><?= clean($data) ?></div>
          </li>
          <?php }
          endif; ?>
        </ul>
        <!-- media -->
        <div class="social <?= !empty($social) ? '' : 'section_hide' ?>">
          <h2 class="heading">Media</h2>
          <?php foreach ($social as $key => $m) { ?>
          <li class="flex mb-1 gap-1 start">
            <span class="on-icon flex"><?= getIcon(get($m, 'social')) ?></span>
            <div class="text"><?= get($m, "handle") ?></div>
          </li>
          <?php } ?>
        </div>
        <!-- SKILL -->
        <div class="skill <?= !empty($skill) ? '' : 'section_hide' ?>">
          <h2 class="heading">Skills</h2>
          <?php foreach ($skill as $key => $m) { ?>
          <p class="list"><?= get($m, "skill") ?> <small class="proficiency clr-warning"
              style="float: right"><?= get($m, "proficiency") ?>%</small></p>
          <?php } ?>
        </div>

        <!-- HOBBY -->
        <div class="hobby <?= !empty($hobby) ? '' : 'section_hide' ?>">
          <h2 class="heading">Hobbies</h2>
          <?php foreach ($hobby as $key => $m) { ?>
          <p class="list"><?= $m ?></p>
          <?php } ?>
        </div>
        <!-- LANGUAGES -->
        <div class="language <?= !empty($language) ? '' : 'section_hide' ?>">
          <h2 class="heading">languages</h2>
          <?php foreach ($language as $key => $m) { ?>
          <p class="list"><?= get($m, "language") ?> <small class="proficiency clr-warning"
              style="float: right"><?= get($m, "proficiency") ?>%</small></p>
          <?php } ?>
        </div>
      </div>
      <div class="layer info-content">
        <!-- SUMMARY -->
        <div class="summary <?= get($personal, 'about') ? '' : 'section_hide' ?>">
          <h2 class="heading">SUMMARY STATEMENT</h2>
          <p><?= get($personal, 'about') ?></p>
        </div>

        <!-- EDUCATION -->
        <div class="section-group <?= !empty($education)  ? '' : 'section_hide' ?>">
          <h2 class="heading">Education</h2>
          <?php foreach ($education as $key => $data) { ?>
          <div class="item">
            <p><span class="txt-capitalize"><?= get($data, 'education') ?></span> | <span
                class="clr-text-muted"><?= get($data, 'school') ?></span></p>
            <p><?= get($data, 'city') ?> | <?= get($data, 'start_date') ?> - <?= get($data, 'end_date') ?>
              <?= get($data, 'present') ? ' | <span class="clr-warning">present</span>' : '' ?>
            <div class="desc pb-2 mt-1">
              <?= makeBody(get($data, 'description')) ?>
            </div>
          </div>
          <?php } ?>
        </div>

        <!--EXPERIENCE -->
        <div class="section-group <?= !empty($experience)  ? '' : 'section_hide' ?>">
          <h2 class="heading">Eexperience</h2>
          <?php foreach ($experience as $key => $data) { ?>
          <div class="item">
            <p><span class="txt-capitalize"><?= get($data, 'position') ?></span> | <span
                class="clr-text-muted"><?= get($data, 'employer') ?></span></p>
            <p><?= get($data, 'city') ?> | <?= get($data, 'start_date') ?> - <?= get($data, 'end_date') ?>
              <?= get($data, 'present') ? ' | <span class="clr-warning">present</span>' : '' ?>
            <div class="desc pb-2 mt-1">
              <?= makeBody(get($data, 'description')) ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php include_once __DIR__ . "/footer.php" ?>
  </article>
</body>

</html>