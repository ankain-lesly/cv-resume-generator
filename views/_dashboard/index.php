<?php

use Devlee\mvccore\Session;

$user = (new Session())->get('user');

$photo = $user['profile'] ? "/uploads/profiles/" . $user['profile'] : "/static/media/user.png";
?>
<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Hi, Welcome <span class="detail txt-capitalize"><?= $user['name'] ?></span></h3>
    </div>
    <div class="feeds-container">
      <div class="feed user-details">
        <div class="box flex txt-center">
          <div class="group">
            <img src="<?= $photo ?>" alt="Profile" />
            <h3><?= $user['name'] ?> </h3>
            <p><?= $user['email'] ?> </p>
            <a class="btn btn-p mt-1" href="/user/profile">Profile</a>
          </div>
        </div>
      </div>
      <div class="feed user-details">
        <div class="box flex txt-center">
          <div class="group">
            <div class="loader"></div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
    <div class="flex pt-2 pb-2">

      <div class="loader"></div>

    </div>
  </div>

</main>