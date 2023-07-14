<div class="Toast_container">
  <?php
      use Devlee\mvccore\Session;
      $toast = (new Session())->getToast('toast');

      if($toast): ?>
        <div class="Toastify_me_dev">
          <div class="toast_box flex between gap-x">
            <span class="toast_icon fas fa-bell"></span>
            <div class="toast_text flex-1">
              <p><?= $toast['message'] ?></p>
            </div>
            <span class="toast_close_btn">&times;</span>
          </div>
        </div>
        <?php 
      endif;
    ?>
</div>