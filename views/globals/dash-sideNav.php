<?php
use App\Models\DataAccess;

$admin  = $_SESSION['user']['role'];
$DataAccess = new DataAccess();

$sql_notifications = "SELECT COUNT(*) AS count FROM tblnotifications WHERE status = 'UNREAD'";

$notifications = $DataAccess->fetchCount('', $sql_notifications)['count']; //status PENDING

// $resumes = $DataAccess->fetchCount('tblpackages')['count']; //status PENDING
$resumes = 0;

?>
<aside class="side-bar  scroll-bar">
  <div class="side-bar-hero">
    <nav class="flex between mb-1">
      <!-- <a href="/" class="padd font-size-small clr-success btn-back">
        <i class="fas fa-arrow-left"></i>
      </a> -->
      <button class="padd btn-close-sidebar mobile">
        <!-- <i class="fas fa-times"></i> -->
        <i class="fas fa-arrow-left"></i>
      </button>
    </nav>
    <div class="content">
      <p class="hero-icon ml-1 clr-warning mb-x">
        <i class="fas fa-book"></i>
      </p>
      <h2 class="clr-warning txt-capitalize  mb-1"><?= $_SESSION['user']['username'] ?></h2>
      <small class="detail">My Admin: <b class="status txt-upper clr-warning"><?= $_SESSION['user']['role'] ?></b></small>
    </div>
  </div>
  <div class="side-bar-links">
    <p class="menu-title">Manage</p>
    <ul class="menu-list">
      <li>
        <a aria-current="page" class="active" href="/dashboard/">
          <i class="fas fa-chart-line icon"></i>
          <span class="text">Dashboard</span></a>
      </li>
      <li class="drop-down">
        <a aria-current="page" class="drop-down-head">
          <!-- <i class="fas fa-bezier-curve icon"></i> -->
          <i class="fas fa-coins icon"></i>
          <span class="text"><label class="notif_indicator"><?= $resumes ?></label> My Resumes</span>
          <i class="fas fa-caret-down drop-caret"></i>
        </a>
        <ul class="drop-down-body">
          <li><a href="#">New Resumes</a></li>
          <li><a href="#">Old Resumes</a></li>
        </ul>
      </li>
      <li class="drop-down">
        <a aria-current="page" class="drop-down-head">
          <i class="fas fa-bezier-curve icon"></i>
          <!-- <i class="fas fa-coins icon"></i> -->
          <span class="text">Templates</span>
          <i class="fas fa-caret-down drop-caret"></i>
        </a>
        <ul class="drop-down-body">
          <li><a href="#">Template One</a></li>
          <li><a href="#">Template Two</a></li>
          <li><a href="#">Template Three</a></li>
        </ul>
      </li>
      <li>
        <a class="" href="/dashboard/show?view=notifications">
          <i class="fas fa-bell icon"></i>
          <span class="text">Notifications</span>
          <?php if ($notifications > 0) { ?>
            <small class="notif_indicator"><?= $notifications > 9 ? $notifications : "0$notifications" ?></small>
          <?php } ?>
        </a>
      </li>
    </ul>
    <p class="menu-title">Create new</p>
    <ul class="menu-list">
      <li>
        <a class="" href="/dashboard/create.php?form=package">
          <i class="fas fa-fill icon"></i>
          <span class="text">CV Resume <i class="fas fa-arrow-right font-size-small pl-x"></i></span></a>
      </li>
    </ul>
    <p class="menu-title">Resources</p>
    <ul class="menu-list">
      <li>
        <a href="/dashboard/get-started">
          <i class="fas fa-network-wired icon"></i>
          <span class="text">Get Started</span></a>
      </li>
    </ul>
    <p class="menu-title">Settings</p>
    <ul class="menu-list">
      <li>
        <a href="/dashboard/profile.php">
          <i class="fas fa-user icon"></i>
          <span class="text">Profile/Account</span></a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-cog icon"></i>
          <span class="text">Settings</span></a>
      </li>
      <li>
        <a href="/dashboard/show?view=trash">
          <i class="fas fa-sort-amount-down icon"></i>
          <span class="text">My Trash <i class="ml-1 fas fa-trash font-size-small clr-warning"></i></span></a>
      </li>
      <li style="margin-top: 2rem;">
        <a href="/dashboard/?logout=true">
          <i class="fas fa-sign-in-alt icon"></i>
          <span class="text">Log out</span></a>
      </li>
    </ul>

    <div class="bottom-gap" style="margin-bottom: 50px;"></div>
  </div>
</aside>