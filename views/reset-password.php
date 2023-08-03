<!-- RESET -->
<?php

$basis = $_GET['verified'] ?? false;
$email = $_POST['reset_email'] ?? '';
?>
<div class="main-container">
  <?php if ($basis) : ?>
  <h2 class="mb-1 txt-center clr-success">Email Verified</h2>
  <p class="txt-center mb-2">In other to proceed with your password reset request, Follow up with the <span
      class="clr-warning">email</span> we sent to your inbox. Thanks</p>
  <h3 class="mt-1 txt-center clr-warning">An email had been sent you 🐱‍🏍</h3>
  <?php else : ?>
  <h2 class="mb-1 txt-center">Reset Password</h2>
  <p class="txt-center mb-2">I've forgotten your my account login password, Enter email address below to proceed</p>
  <?php endif; ?>
  <!-- // Form messages -->
  <div class="form-message <?= $error ? "error" : '' ?> shake_anim" id="form-message"><?= $error ? $error : '' ?></div>

  <form id="reset_form" method="post">
    <?php if (!$basis) : ?>
    <!-- // reset email -->
    <div class="form-group flex gap-x">
      <label for="reset_email" class="icon">
        <i class="fas fa-user"></i>
      </label>
      <input type="email" id="reset_email" name="reset_email" placeholder="Enter you account email address"
        autocomplete="on" required value="<?= $email ?>" />
      <label for="reset_email" class="status-msg shake_anim"></label>
      <label class="fas fa-info info"></label>
    </div>

    <button class="flex mt-2 mb-2 form_btn" type="submit">
      <span class="mr-1 p-main"> Proceed </span>
      <i class="fas fa-arrow-right p-main"></i>
      <span class="p-odd mr-1">Processing...</span>
      <span class="p-odd loader inline-text mr-1"></span>
    </button>
    <?php endif; ?>

  </form>
</div>