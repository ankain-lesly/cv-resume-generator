<?php require_once __DIR__ . "/props.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Design 1 | Resume Template</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/resumes/design/<?= $css_file ?>">
</head>

<body>
  <article id="template_main">
    <div class="rela-block top-bar">
      <div class="caps name">
        <h1 class="abs-center"><?= get($personal, 'firstname') . ' ' . get($personal, 'lastname') ?></h1>
      </div>
    </div>
    <div class="side-bar">
      <div class="profile <?= $cover ? '' : 'section_hide' ?>">
        <img src="<?= $cover ?>" class="img-cover" alt="Profile image">
      </div>

      <p class="txt-center"><?= get($personal, 'headline') ?></p>
      <div class="rela-block separator pb-2 mb-2"></div>

      <ul class="personal pt-2 mt-2">
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
      <!-- social -->
      <div class="social <?= !empty($social) ? '' : 'section_hide' ?>">
        <h3 class="rela-block caps side-header">Social</h3>
        <?php foreach ($social as $key => $m) { ?>
        <li class="flex mb-1 gap-1 start">
          <span class="on-icon flex"><?= getIcon(get($m, 'social')) ?></span>
          <div class="text"><?= get($m, "handle") ?></div>
        </li>
        <?php } ?>
      </div>

      <!-- SKILLS -->
      <div class="skill <?= !empty($skill) ? '' : 'section_hide' ?>">
        <h3 class="rela-block caps side-header">Skills</h3>
        <?php foreach ($skill as $key => $data) { ?>
        <p class="rela-block list-thing"><?= get($data, 'skill') ?></p>
        <?php } ?>
      </div>

      <!-- HOBBIES -->
      <div class="hobby <?= !empty($hobby) ? '' : 'section_hide' ?>">
        <h3 class="rela-block caps side-header">Hobbies</h3>
        <?php foreach ($hobby as $key => $data) { ?>
        <p class="rela-block list-thing"><?= clean($data) ?></p>
        <?php } ?>
      </div>
    </div>
    <div class="rela-block content-container">
      <!-- ABOUT -->
      <div class=" <?= get($personal, 'about')  ? '' : 'section_hide' ?>">
        <div class="rela-block caps greyed heading">Profile</div>
        <p class="long-margin"><?= get($personal, 'about') ?></p>
      </div>

      <!-- EDUCATION -->
      <div class="section-group <?= !empty($education)  ? '' : 'section_hide' ?>">
        <div class="rela-block caps greyed heading">Education</div>
        <?php foreach ($education as $key => $data) { ?>
        <h3 class="mt-2"><?= get($data, 'education') ?>
          <?= get($data, 'present') ? '<small class="txt- detail">present</small>' : '' ?></h3>
        <p class="light"><?= get($data, 'start_date') ?> - <?= get($data, 'end_date') ?></p>
        <p><?= get($data, 'school') ?> | <?= get($data, 'city') ?></p>
        <div class="desc pb-2 mt-1">
          <?= makeBody(get($data, 'description')) ?>
        </div>
        <?php } ?>
      </div>

      <!-- EXPERIENCE -->
      <div class="section-group <?= !empty($experience)  ? '' : 'section_hide' ?>">
        <div class="rela-block caps greyed heading">Experience</div>
        <?php foreach ($experience as $key => $data) { ?>
        <h3 class="mt-2"><?= get($data, 'position') ?>
          <?= get($data, 'present') ? '<small class="txt- detail">present</small>' : '' ?></h3>
        <p class="light"><?= get($data, 'start_date') ?> - <?= get($data, 'end_date') ?></p>
        <p><?= get($data, 'employer') ?> | <?= get($data, 'city') ?></p>
        <div class="desc pb-2 mt-1">
          <?= makeBody(get($data, 'description')) ?>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php include_once __DIR__ . "/footer.php" ?>
  </article>
</body>

</html>