<div class="Toast_container">
  <?php
      if(isset($_SESSION['toast'])): ?>
  <div class="Toastify_me_dev">
    <div class="toast_box flex between gap-x">
      <span class="toast_icon fas fa-bell"></span>
      <div class="toast_text flex-1">
        <p><?= $_SESSION['toast']['message'] ?></p>
      </div>
      <span class="toast_close_btn">&times;</span>
    </div>
  </div>
  <?php 
      endif;
      unset($_SESSION['toast']);
    ?>
</div>