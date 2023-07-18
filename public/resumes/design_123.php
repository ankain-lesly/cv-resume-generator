<?php

    function clean(string $value) {
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $value = trim($value);
        return $value;
  }
    function get(array $data, string $key) {
        $value = $data[$key] ?? ''; 
        return  empty($value) ? $value : clean($value);
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Resume stuff</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->
  <link rel="stylesheet" href="/resumes/design/design_123.css">

</head>
<body>
<!-- PAGE STUFF -->
<div class="rela-block page">
    <div class="rela-block top-bar">
        <div class="caps name"><div class="abs-center"><?= get($personal, 'firstname') ?> <?= get($personal, 'lastname') ?></div></div>
    </div>
    <div class="side-bar">
        <div class="mugshot">
            <div class="logo">
                <svg viewbox="0 0 80 80" class="rela-block logo-svg">
                    <path d="M 10 10 L 52 10 L 72 30 L 72 70 L 30 70 L 10 50 Z" stroke-width="2.5" fill="none"/>
                </svg>
                <p class="logo-text">kj</p>
            </div>
        </div>
        <p class="info <?= empty(get($personal,'address')) ? 'section_hide' : ''?>"><?= get($personal,'address') ?></p>
        <p class="info <?= empty(get($personal,'date_of_birth')) ? 'section_hide' : ''?>"><?= get($personal,'date_of_birth') ?></p>
        <p class="info <?= empty(get($personal,'email')) ? 'section_hide' : ''?>"><?= get($personal,'email') ?></p>
        <p class="info <?= empty(get($personal,'phone')) ? 'section_hide' : ''?>"><?= get($personal,'phone') ?></p>

        <p class="rela-block social twitter">Twitter stuff</p>
        <p class="rela-block social pinterest">Pinterest things</p>
        <p class="rela-block social linked-in">Linked-in man</p>

        <!-- SKILLS -->
        <div class="group <?= empty($languages) ? 'section_hide' : ''?>">
            <h3 class="rela-block caps side-header">Languages</h3>
            <?php foreach ($languages as $key => $language) {?>
                <p class="rela-block list-thing"><?= get($language, 'language') ?></p>
            <?php } ?>
        </div>

        <!-- SKILLS -->
        <div class="group <?= empty($skills) ? 'section_hide' : ''?>">
            <h3 class="rela-block caps side-header">Expertise</h3>
            <?php foreach ($skills as $key => $skill) {?>
                <p class="rela-block list-thing"><?= get($skill, 'skill') ?></p>
            <?php } ?>
        </div>

        <!-- HOBBIES -->
        <div class="group <?= empty($hobbies) ? 'section_hide' : ''?>">
            <h3 class="rela-block caps side-header">Hobbies</h3>
            <?php foreach ($hobbies as $key => $hobby) {?>
                <p class="rela-block list-thing"><?= clean($hobby) ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="rela-block content-container">
        <!-- ABOUT -->
        <div class="group <?= empty(get($personal, 'headline')) ? 'section_hide' : ''?>">
            <h2 class="rela-block caps title"><?= get($personal, 'headline') ?></h2>
            <div class="rela-block separator"></div>
        </div>
        <div class="rela-block caps greyed">Profile</div>
        <p class="long-margin">ABOUT ME HERE</p>

        <!-- EDUCATION -->
        <div class="group <?= empty($education) ? 'section_hide' : ''?>">
            <div class="rela-block caps greyed">Education</div>
            <?php foreach ($education as $key => $data) {?>
                <br>
                <h3><?= get($data,'education') ?></h3>
                <p class="light"><?= get($data,'school') ?></p>
                <p class="justified"><?= get($data,'description') ?></p>
            <?php } ?>
        </div>

        <!-- EXPERIENCE -->
        <div class="group <?= empty($experience) ? 'section_hide' : ''?>">
            <div class="rela-block caps greyed">Experience</div>
            <?php foreach ($experience as $key => $data) { ?>
                <br>
                <h3><?= get($data, 'position')?></h3>
                <p class="light"><?= get($data, 'employer') .', '.get($data, 'city') ?></p>
                <p class="justified"><?= get($data, 'description') ?></p>
            <?php } ?>
        </div>

        <footer class="txt-center pt-1 pb-1">LeTECH &copy; Reume maker - 2022</footer>
    </div>
</div>
<!-- partial scripts -->
  
</body>
</html>