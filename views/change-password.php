<!-- RESET -->
<?php

// $reset = $_GET['reset'] ?? false;
// $basis = $_GET['verified'] ?? false;
// $email = $_POST['reset_email'] ?? '';
?>
<div class="main-container">
  <h2 class="mb-1 txt-center clr-warning">Reset Passord</h2>
  <p class="txt-center mb-2">Enter new password below</p>
  <!-- // Form messages -->
  <div class="form-message <?= $error ? "error" : '' ?> shake_anim" id="form-message"><?= $error ? $error : '' ?></div>

  <form id="reset_form" method="post">

    <!-- // Passwird -->
    <div class="form-group flex gap-x">
      <label for="password" class="icon">
        <i class="fas fa-lock"></i>
      </label>
      <input type="password" id="password" name="password" placeholder="Enter new Password" autocomplete="on" />
      <label for="password" class="status-msg shake_anim"></label>
      <label data-toggle-type="#password" for="password" title="toggle visibility" class="fas fa-eye visibility">
      </label>
    </div>
    <!-- // Passwird -->
    <div class="form-group flex gap-x">
      <label for="confirm_password" class="icon">
        <i class="fas fa-lock"></i>
      </label>
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password"
        autocomplete="on" />
      <label for="confirm_password" class="status-msg shake_anim"></label>
      <label data-toggle-type="#confirm_password" for="confirm_password" title="toggle visibility"
        class="fas fa-eye visibility">
      </label>
    </div>

    <!-- Remember me  -->
    <div class="group">
      <input type="checkbox" id="keep_alive" />
      <label for="keep_alive">Remember me</label>
    </div>

    <button class="flex mt-2 mb-2 form_btn" type="submit">
      <span class="mr-1 p-main"> Change password </span>
      <i class="fas fa-arrow-right p-main"></i>
      <span class="p-odd mr-1">Processing...</span>
      <span class="p-odd loader inline-text mr-1"></span>
    </button>

  </form>
</div>