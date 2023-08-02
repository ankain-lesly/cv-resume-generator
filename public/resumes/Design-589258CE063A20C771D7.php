<?php require_once __DIR__ . "/props.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>Design 2 | Resume Template</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/static/styles/index.css">
  <link rel="stylesheet" href="/static/styles/Design_2.css">
</head>

<body>
  <article id="template_main">
    <header>
      <h1>Curriculum Vitae</h1>
      <h3>Personal Details</h3>
      <div class="container flex mt-2">
        <div class="profile <?= $cover ? '' : 'section_hide' ?>">
          <div class="image">
            <img src="<?= $cover ?>" class="img-cover" alt="Profile image">
          </div>
          <h3 class="pt-2"><?= getP('headline') ?></h3>
        </div>
        <div class="details">
          <ul>
            <li><b>NAME:</b> <?= getP('firstname') . ' ' . getP('lastname')  ?></li>

            <li><b>DATE OF BIRTH:</b> 12/09/2012</li>
            <li><b>PLACE OF BIRTH:</b> Bamend Fundon</li>
            <li><b>MARITAL STATUS:</b> Single</li>
            <li><b>NATIONALITY:</b> Cameroon</li>

            <li><b>TEL:</b> <?= getP('phone') ?></li>
            <li><b>EMAIL:</b> <?= getP('email') ?></li>
            <li class="mb-1"><b>ADDRESS:</b> <?= getP('address') ?></li>
            <!-- 
            <?php
            foreach ($extras as $key => $data) { ?>
            <li><b class="txt-upper"><?= $key ?>:</b> <?= clean($data) ?></li>
            <?php } ?> -->
          </ul>
        </div>
      </div>
    </header>
    <div class="eduction <?= !empty($education) ? '' : 'section_hide' ?>">
      <table border="1px">
        <thead>
          <tr>
            <th colspan="100">
              <h3>EDUCATIONAL QUALIFICATION</h3>
            </th>
          </tr>
          <tr>
            <th>YEAR</th>
            <th>SCHOOL ATTENDED</th>
            <th>SCHOOL CERTIFICATE OBTAINED</th>
            <th>CITY</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($education as $key => $data) { ?>
            <tr>
              <td><?= get($data, 'start_date') ?></td>
              <td><?= get($data, 'school') ?></td>
              <td><?= get($data, 'education') ?></td>
              <td><?= get($data, 'city') ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="work <?= !empty($experience) ? '' : 'section_hide' ?>">
      <table border="1px">
        <thead>
          <tr>
            <th colspan="100">
              <h3>WORKING EXPERIENCE</h3>
            </th>
          </tr>
          <tr>
            <th>YEAR</th>
            <th>INSTITUTION</th>
            <th>POSITION</th>
            <th>CITY</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($experience as $key => $data) { ?>
            <tr>
              <td><?= get($data, 'start_date') ?></td>
              <td><?= get($data, 'employer') ?></td>
              <td><?= get($data, 'position') ?></td>
              <td><?= get($data, 'city') ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="group flex between gap-2 top">
      <div class="languages flex-1 <?= !empty($language) ? '' : 'section_hide' ?>">
        <table border="1px">
          <thead>
            <tr>
              <th colspan="100">
                <h3>KNOWLEDGE OF LANGUAGES</h3>
              </th>
            </tr>
            <tr>
              <th>LANGUAGE</th>
              <th>PROFICIENCY</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($language as $key => $data) { ?>
              <tr>
                <td><?= get($data, 'language') ?></td>
                <td><?= get($data, 'proficiency') ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="skill flex-1 <?= !empty($experience) ? '' : 'section_hide' ?>">
        <table border="1px">
          <thead>
            <tr>
              <th colspan="100">
                <h3>YOUR PERSONAL SKILLS</h3>
              </th>
            </tr>
            <tr>
              <th>SKILL</th>
              <th>PROFICIENCY</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($skill as $key => $data) { ?>
              <tr>
                <td><?= get($data, 'skill') ?></td>
                <td><?= get($data, 'proficiency') ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="hobbies flex-1 <?= !empty($hobby) ? '' : 'section_hide' ?>">
        <table border="1px">
          <thead>
            <tr>
              <th colspan="100">
                <h3>HOBBIES</h3>
              </th>
            </tr>
            <tr>
              <th>HOBBY</th>
              <th>PROFICIENCY</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hobby as $key => $data) { ?>
              <tr>
                <td><?= $data ?></td>
                <td><?= $data ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php include_once __DIR__ . "/footer.php" ?>
  </article>
</body>

</html>