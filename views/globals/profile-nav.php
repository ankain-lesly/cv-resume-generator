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
      <li>
        <a class="link flex" href="/dashboard/">
          <i class="fas fa-chart-pie icon" style="width:1.2rem"></i>
          <span class="text">Dashboard</span></a>
      </li>
      <li>
        <a class="link flex" href="/dashboard/?create=resume">
          <i class="fas fa-edit icon" style="width:1.2rem"></i>
          <span class="text">Create Resume</span></a>
      </li>
      <li>
        <a class="link flex" href="/dashboard/#notifications">
          <i class="fas fa-bell icon" style="width:1.2rem"></i>
          <span class="text"> Notifications</span></a>
      </li>
      <li>
        <a class="link flex" href="/">
          <i class="fas fa-arrow-left icon" style="width:1.2rem"></i>
          <span class="text">Home</span></a>
      </li>
      <li class="mt-2">
        <a class="bbtn secondary w-full" href="/account/logout" onclick="return confirm('Do you want to logout?')">Logout</a>
      </li>
    </ul>
  </nav>
</div>