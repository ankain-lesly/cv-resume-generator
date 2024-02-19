<?php
// $sql_notifications = "SELECT COUNT(*) AS count FROM tblnotifications WHERE status = 'UNREAD'";

use Devlee\mvccore\DB\DataAccess;
use Devlee\mvccore\Session;

$session = new Session();
$DataAccess = new DataAccess();

$user = $session->get('user');
// $notifications = $DataAccess->fetchCount('', $sql_notifications)['count']; //status PENDING
$resumes = $DataAccess->findCount('tblresume_metadata', ['user_id' => $user['userID']])['count'];
$templates = $DataAccess->findCount('tbltemplates', ['user_id' => $user['userID']])['count'];

$notifications = 1;

?>
<aside class="side-bar  scroll-bar">
  <div class="side-bar-hero">
    <nav class="flex between mb-2">
      <a href="/" class="padd btn-home clr-success flex gap-x">
        <i class="fas fa-arrow-left"></i>
        <b class="clr-success font-size-small">Home</b>
      </a>

      <span></span>

      <button class="padd btn-close-sidebar clr-warning px-1">
        <i class="fas fa-times"></i>
      </button>
    </nav>
    <div class="content ">
      <p class="hero-icon clr-warning mb-x">
        <i class="fas fa-briefcase"></i>
      </p>
    </div>
    <div class="stats-main no-scroll-bar">
      <ul class="stats flex between gap-x">
        <li class="stat right flex"><i class="fas fa-angle-left"></i></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
        <li class="stat"></li>
      </ul>
    </div>
  </div>
  <div class="side-bar-links">
    <p class="menu-title">Manage</p>
    <ul class="menu-list">
      <li>
        <a aria-current="page" href="/app/">
          <i class="fas fa-chart-line icon"></i>
          <span class="text">Dashboard</span></a>
      </li>
      <li>
        <a aria-current="page" href="/app/resumes">
          <i class="fas fa-coins icon"></i>
          <span class="text"><label class="notif_indicator"><?= $resumes ?></label> My Resumes</span></a>
      </li>
      <?php if ($user['role'] != "USER") : ?>
        <li>
          <a aria-current="page" href="/templates/resume">
            <i class="fas fa-bezier-curve icon"></i>
            <span class="text"><label class="notif_indicator"><?= $templates ?></label> Resume Templates</span></a>
        </li>
      <?php else : ?>
        <li>
          <a aria-current="page" href="#not-authorized" style="opacity: 0.5;" onclick="return alert('Not authorize: User eligibility')">
            <i class="fas fa-bezier-curve icon"></i>
            <span class="text clr-muted"> Resume Templates</span></a>
        </li>
      <?php endif; ?>
      <li>
        <a class="" href="#notifications">
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
        <a class="" href="/app/?create=resume">
          <i class="fas fa-fill icon"></i>
          <span class="text">New Resume <i class="fas fa-arrow-right font-size-small pl-x"></i></span></a>
      </li>

      <?php if ($user['role'] != "USER") : ?>

        <li>
          <a class="" href="/new/template">
            <i class="fas fa-edit icon"></i>
            <span class="text">Add Template <i class="fas fa-arrow-right font-size-small pl-x"></i></span></a>
        </li>
      <?php else : ?>
        <li>
          <a class="" href="#not-authorized" style="opacity: 0.5;" onclick="return alert('Not authorize: User eligibility')">
            <i class="fas fa-edit icon"></i>
            <span class="text">Add Template <i class="fas fa-arrow-right font-size-small pl-x"></i></span></a>
        </li>
      <?php endif; ?>
    </ul>
    <p class="menu-title">Resources</p>
    <ul class="menu-list">
      <li>
        <a href="/app/get-started">
          <i class="fas fa-network-wired icon"></i>
          <span class="text">Get Started</span></a>
      </li>
    </ul>
    <p class="menu-title">Settings</p>
    <ul class="menu-list">
      <li>
        <a href="/user/profile">
          <i class="fas fa-user icon"></i>
          <span class="text">Profile/Account</span></a>
      </li>
      <li>
        <a href="/account/settings">
          <i class="fas fa-cog icon"></i>
          <span class="text">Settings</span></a>
      </li>
      <!-- <li>
        <a href="/app/show?view=trash">
          <i class="fas fa-sort-amount-down icon"></i>
          <span class="text">My Trash <i class="ml-1 fas fa-trash font-size-small clr-warning"></i></span></a>
      </li> -->
      <li style="margin-top: 2rem;">
        <a href="/account/logout" onclick="return confirm('Do you want to logout?')">
          <i class="fas fa-sign-in-alt icon"></i>
          <span class="text">Log out</span></a>
      </li>
    </ul>

    <div class="bottom-gap" style="margin-bottom: 50px;"></div>
  </div>
</aside>