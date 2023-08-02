<?php require_once __DIR__ . "/props.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Design 4 | Resume Template</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/static/styles/index.css">
  <link rel="stylesheet" href="/static/styles/Design_4.css">
</head>

<body>
  <article id="template_main">
    <div class="layer side">
      <div class="profile <?= $cover ? '' : 'section_hide' ?>">
        <img src="<?= $cover ?>" class="img-cover" alt="Profile image">
      </div>
      <!-- personal -->
      <ul class="personal">
        <li class="flex mb-x gap-1 start top <?= getP('phone') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("phone") ?></span>
          <div class="text"><?= getP('phone') ?></div>
        </li>
        <li class="flex mb-x gap-1 start top <?= getP('email') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("email") ?></span>
          <div class="text"><?= getP('email') ?></div>
        </li>
        <li class="flex mb-x gap-1 start top <?= getP('address') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("address") ?></span>
          <div class="text"><?= getP('address') ?></div>
        </li>
        <li class="flex mb-x gap-1 start top <?= getP('date_of_birth') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("date") ?></span>
          <div class="text"><?= getP('date_of_birth') ?></div>
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
      <div class="social item <?= !empty($social) ? '' : 'section_hide' ?>">
        <h3 class="heading">Media</h3>
        <?php foreach ($social as $key => $m) { ?>
        <li class="flex mb-1 gap-1 start">
          <span class="on-icon flex"><?= getIcon(get($m, 'social')) ?></span>
          <div class="text"><?= get($m, "handle") ?></div>
        </li>
        <?php } ?>
      </div>
      <!-- skill -->
      <div class="skill item<?= !empty($skill) ? '' : 'section_hide' ?>">
        <h3 class="heading">Expertise</h3>
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
    <div class="layer content">
      <div class="about">
        <h1><?= getP('firstname') . ' ' . getP('lastname') ?></h1>
        <h3 class="pb-1"><?= getP('headline') ?></h3>
        <div class="info mt-2">
          <h4>Profile</h4>
          <p><?= getP('about') ?></p>
        </div>
      </div>


      <!-- EDUCATION -->
      <div class="section-group <?= !empty($education) ? '' : 'section_hide' ?>">
        <h2 class="heading">Education</h2>
        <?php foreach ($education as $key => $data) { ?>
        <div class="accordion">
          <div class="caption">
            <p><?= get($data, 'school') ?></p>
            <small><?= get($data, 'start_date') ? get($data, 'start_date') : get($data, 'end_date') ?> |
              <?= get($data, 'city') ?></small>
          </div>
          <div class="desc">
            <p class="title txt-capitalize"><?= get($data, 'education') ?>
              <?= get($data, 'present') ? '  <span class="detail ml-1">present</span>' : '' ?></p>

            <?= makeBody(get($data, 'description')) ?>
          </div>
        </div>
        <?php } ?>
      </div>
      <!-- EXPERIENCE -->
      <div class="section-group <?= !empty($experience) ? '' : 'section_hide' ?>">
        <h2 class="heading">Experience</h2>
        <?php foreach ($experience as $key => $data) { ?>
        <div class="accordion">
          <div class="caption">
            <p><?= get($data, 'employer') ?></p>
            <small><?= get($data, 'start_date') ? get($data, 'start_date') : get($data, 'end_date') ?> |
              <?= get($data, 'city') ?></small>
          </div>
          <div class="desc">
            <p class="title txt-capitalize"><?= get($data, 'position') ?>
              <?= get($data, 'present') ? '  <span class="detail ml-1">present</span>' : '' ?></p>

            <?= makeBody(get($data, 'description')) ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php include_once __DIR__ . "/footer.php" ?>
  </article>
</body>

</html>