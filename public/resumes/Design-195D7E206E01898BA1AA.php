<?php require_once __DIR__ . "/props.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Design 5 | Resume Template</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- <link rel="stylesheet" href="/static/styles/index.css"> -->
  <link rel="stylesheet" href="/resumes/design/<?= $css_file ?>">
</head>

<body>
  <article id="template_main">
    <div class="head">
      <h1><?= get($personal, "firstname") ?> <?= get($personal, "lastname") ?> </h1>
      <div class="headline flex gap-3 <?= get($personal, "phone") ? "" : 'section_hide' ?>">
        <div class=" line flex-1"></div>
        <h3><?= get($personal, "headline") ?></h3>
        <div class="line flex-1"></div>
      </div>
      <div class="info flex top">
        <li class="section flex mb-x gap-1 column <?= get($personal, 'address') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("address") ?></span>
          <div class="text"><?= get($personal, 'address') ?></div>
        </li>
        <li class="section flex mb-x gap-1 column <?= get($personal, 'phone') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("phone") ?></span>
          <div class="text"><?= get($personal, 'phone') ?></div>
        </li>
        <li class="section flex mb-x gap-1 column <?= get($personal, 'email') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("email") ?></span>
          <div class="text"><?= get($personal, 'email') ?></div>
        </li>
        <li class="section flex mb-x gap-1 column <?= get($personal, 'date_of_birth') ? '' : 'section_hide' ?>">
          <span class="on-icon flex"><?= getIcon("date") ?></span>
          <div class="text"><?= get($personal, 'date_of_birth') ?></div>
        </li>
      </div>
    </div>
    <div class="body">
      <div class="layer side">

        <div class="profile <?= $cover ? '' : 'section_hide' ?>">
          <img src="<?= $cover ?>" class="img-cover" alt="Profile image" width="300px">
        </div>
        <!-- personal -->
        <ul class="personal">
          <?php
          foreach ($extras as $key => $data) { ?>
          <li class="flex mb-1 gap-1 start">
            <span class="on-icon flex"><?= getIcon($key) ?></span>
            <div class="text"><?= clean($data) ?></div>
          </li>
          <?php } ?>
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

        <!-- hobby -->
        <div class="hobby item <?= !empty($hobby) ? '' : 'section_hide' ?>">
          <h3 class="heading">Hobbies</h3>
          <?php foreach ($hobby as $key => $m) { ?>
          <p class="list"><?= clean($m) ?></p>
          <?php } ?>
        </div>

        <!-- languages -->
        <div class="language item <?= !empty($language) ? '' : 'section_hide' ?>">
          <h3 class="heading">Languages</h3>
          <?php foreach ($language as $key => $m) { ?>
          <div class="range mb-2">
            <p><?= get($m, 'language') ?></p>
            <div class="bar mt-1" style="--range:<?= get($m, 'proficiency') ?>%"></div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="layer content">
        <div><?= get($personal, 'about') ?></div>

        <!-- EDUCATION -->
        <div class="section-group <?= !empty($education) ? '' : 'section_hide' ?>">
          <h2 class="heading">education</h2>
          <?php foreach ($education as $key => $data) { ?>
          <div class="item pb-2">
            <h2><?= get($data, 'education') ?>
              <?= get($data, 'present') ? '  <small class="clr-warning">present</small>' : '' ?></h2>
            <p class="clr-text-muted mt-x mb-1"><span class="txt-capitalize"><?= get($data, 'school') ?></span> |
              <?= get($data, 'start_date') ?> to <?= get($data, 'end_date') ?> | <?= get($data, 'city') ?></p>
            <div class="desc">
              <?= makeBody(get($data, 'description')) ?>
            </div>
          </div>
          <?php } ?>
        </div>

        <!-- experience -->
        <div class="section-group <?= !empty($experience) ? '' : 'section_hide' ?>">
          <h2 class="heading">Experience</h2>
          <?php foreach ($experience as $key => $data) { ?>
          <div class="item pb-2">
            <h2><?= get($data, 'position') ?>
              <?= get($data, 'present') ? '  <small class="clr-warning">present</small>' : '' ?></h2>
            <p class="clr-text-muted mt-x mb-1"><span class="txt-capitalize"><?= get($data, 'employer') ?></span> |
              <?= get($data, 'start_date') ?> to <?= get($data, 'end_date') ?> | <?= get($data, 'city') ?></p>
            <div class="desc">
              <?= makeBody(get($data, 'description')) ?>
            </div>
          </div>
          <?php } ?>
        </div>
        <!-- skill -->
        <div class="skills <?= !empty($skill) ? '' : 'section_hide' ?>">
          <h3 class="heading">Expertise</h3>
          <div class="item skill">
            <?php foreach ($skill as $key => $m) { ?>
            <div class="range mb-2">
              <p><?= get($m, 'skill') ?></p>
              <div class="bar mt-1" style="--range:<?= get($m, 'proficiency') ?>%"></div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php include_once __DIR__ . "/footer.php" ?>
  </article>
</body>

</html>