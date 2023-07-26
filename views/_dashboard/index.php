<?php

$cars = ['count' => 8];
$brands = ['count' => 8];
$parts = ['count' => 8];
$categories = ['count' => 8];
$years = ['count' => 8];
$users = ['count' => 8];

?>
<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Hi, Welcome <span class="detail txt-capitalize">Username</span></h3>
    </div>
    <div class="feeds-container">
      <div class="feed user-details">
        <div class="box flex txt-center">
          <div class="group">
            <img src="/static/media/user.png" alt="Profile AnkainDa" />
            <h3>username</h3>
            <p>email</p>
            <a class="btn btn-p mt-1" href="/dashboard/">Pofile</a>
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