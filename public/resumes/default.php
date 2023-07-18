<?php
    $personal = $resume['personal'] ?? [];
    $personal_extras = $resume['personal']['extras'] ?? [];

    $education = $resume['education'] ?? [];
    $experience = $resume['experience'] ?? [];
    $languages = $resume['languages'] ?? [];
    $skills = $resume['skills'] ?? [];
    $hobbies = $resume['hobbie'] ?? [];

    function personal($key) {
        return $GLOBALS['personal'][$key] ?? '';
    }
?>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Resume stuff</title>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->
    <style type="text/css">
        .template_main {
            min-height: 700px;
        }
        header {
            background: #333;
            color: #fff;
            padding: 2rem 0.5rem;
            text-align: center;
        }
        .template_main .content {
            display: flex;
            grid-template-columns: 500px auto;
        }
        .template_main .side {
            background: brown;
            color: #fff;
            padding: 1rem;
        }
        .template_main .main {
            padding: 2rem;
            border: 2px solid green;
            width: 100%;
        }
        .section_hide {
            display: none!important;
        }
    </style>  
</head>
<body>
<!-- PAGE STUFF -->
<div class="template_main">
    <header>
        <h2>My Resume | Default</h2>
    </header>
    <div class="content">
        <div class="side">
            <h3>Personal Info</h3>
            <br>
            <p class="info <?= empty(personal('firstname')) ? 'section_hide' : ''?>"><?= personal('firstname') .' '. personal('lastname') ?></p>
            <p class="info <?= empty(personal('headline')) ? 'section_hide' : ''?>"><?= personal('headline') ?></p>
            
            <p class="info <?= empty(personal('address')) ? 'section_hide' : ''?>"><?= personal('address') ?></p>
            <p class="info <?= empty(personal('date_of_birth')) ? 'section_hide' : ''?>"><?= personal('date_of_birth') ?></p>
            <p class="info <?= empty(personal('email')) ? 'section_hide' : ''?>"><?= personal('email') ?></p>
            <p class="info <?= empty(personal('phone')) ? 'section_hide' : ''?>"><?= personal('phone') ?></p>
            <br>
            <br>

            <!-- SKILLS -->
            <div class="group <?= empty($languages) ? 'section_hide' : ''?>">
                <h3 class="rela-block caps side-header">Languages</h3>
                <?php foreach ($languages as $language) {?>
                    <p class="rela-block list-thing"><?= $language['language'] ?></p>
                <?php } ?>
            </div>
            <br>
            <br>

            <!-- SKILLS -->
            <div class="group <?= empty($skills) ? 'section_hide' : ''?>">
                <h3 class="rela-block caps side-header">Expertise</h3>
                <?php foreach ($skills as $skill) {?>
                    <p class="rela-block list-thing"><?= $skill['skill'] ?></p>
                <?php } ?>
            </div>
            <br>
            <br>

            <!-- HOBBIES -->
            <div class="group <?= empty($language) ? 'section_hide' : ''?>">
                <h3 class="rela-block caps side-header">Hobbies</h3>
                <?php foreach ($hobbies as $hobby) {?>
                    <p class="rela-block list-thing"><?= $hobby['hobby'] ?></p>
                <?php } ?>

            </div>
        </div>
        <div class="main">
            <!-- EDUCATION -->
            <div class="group <?= empty($education) ? 'section_hide' : ''?>">
                <div class="rela-block caps greyed">Education</div>
                <?php foreach ($education as $data) {?>
                    <h3><?= $data['education'] ?></h3>
                    <p class="light"><?= $data['shool'] ?></p>
                    <p class="justified"><?= $data['description'] ?></p>
                <?php } ?>
            </div>
            <br>
            <br>
            
             <!-- EXPERIENCE -->
            <div class="group <?= empty($experience) ? 'section_hide' : ''?>">
                <div class="rela-block caps greyed">Experience</div>
                <?php foreach ($experience as $data) { ?>
                    <h3><?= $data['position'] ?></h3>
                    <p class="light"><?= $data['employer'].', '.$data['city'] ?></p>
                    <p class="justified"><?= $data['description'] ?></p>
                <?php } ?>
            </div>
            <br>
            <br>

            <footer class="txt-center pt-1 pb-1">LeTECH &copy; Reume maker - 2022</footer>
        </div>        
    </div>
</div>
<!-- partial scripts -->
  
</body>
</html>