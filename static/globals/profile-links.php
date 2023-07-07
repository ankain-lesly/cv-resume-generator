<div class="user_profile flex">
  <!-- <h4>username</h4> -->
  <div class="thumbnail">
    <img class="ml-x mr-x profile-icon-x" src="/static/media/user.png" alt=" user profile">
  </div>
  <span class="padd">
    <i class="fas fa-caret-down"></i>
  </span>
  <nav class="drop_menu">
    <ul class="menu_container">
      <?php if (isset($_SESSION['user']['username'])) { ?>
        <li>
          <a class="link flex" href="/dashboard/">
            <i class="fas fa-chart-pie icon" style="width:1.2rem"></i>
            <span class="ml-2">Dashboard</span></a>
        </li>
        <li>
          <a class="link flex" href="/dashboard/">
            <i class="fas fa-edit icon" style="width:1.2rem"></i>
            <span class="ml-2">Create CV</span></a>
        </li>
        <li>
          <a class="link flex" href="/dashboard/show.php?view=notifications">
            <i class="fas fa-bell icon" style="width:1.2rem"></i>
            <span class="ml-2"> Notifications</span></a>
        </li>
        <li>
          <a class="link flex" href="/">
            <i class="fas fa-arrow-left icon" style="width:1.2rem"></i>
            <span class="ml-2">Home Page`</span></a>
        </li>
        <li>
          <a class="link flex" href="/dashboard/?logout=true">
            <i class="fas fa-user-alt" style="width:1.2rem"></i>
            <span class="ml-2">Logout</span></a>
        </li>
      <?php } ?>
      <li>
        <div class="currency-component" style="margin-left: auto">
          <button class="currency-btn btnB w-full txt-right">
            <small class="text font-size-small">Data one</small>
            <i class="fas fa-caret-down"></i>
          </button>
          <div class="currency-container">
            <ul class="currencies">
              <li class="currency">
                <a href="#">
                  <span class="text">Data Two</span>
                  <i class="fas fa-caret-left"></i>
                </a>
              </li>
              <li class="currency">
                <a href="#" class="active">
                  <span class="text">Data Three</span>
                  <i class="fas fa-caret-left"></i>
                </a>
              </li>
              <li class="currency">
                <a href="#">
                  <span class="text">Data Four</span>
                  <i class="fas fa-caret-left"></i>
                </a>
              </li>
              <li class="currency">
                <a href="#">
                  <span class="text">Transcripts</span>
                  <i class="fas fa-caret-left"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </nav>
</div>