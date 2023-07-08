<header class="main-header">
  <div class="container-x gap-2 flex between header-h">
    <a href="/">
      <h1 class="main-header-title"><span class="clr-warning">CV </span> Maker</h1>
    </a>
    <nav class="nav-menu">
      <button class="screen-overflow mobile" data-target="nav-menu"></button>
      <div class="nav-menu-container">
        <div class="nav-menu-head mobile">
          <div class="nav flex between mb-1">
            <h2>CV - Maker</h2>
            <button class="btnB close-nav-menu">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Earum, debitis?
          </p>
        </div>
        <div class="nav-menu-body">
          <div class="nav-links flex gap-2">
            <a href="/" class="nav-link">
              <span class="text">Home</span>
            </a>

            <div href="#" class="dropdown">
              <div class="dropdown-head nav-link">
                <span class="text">Our Desigs </span>
                <i class="fas fa-caret-down font-size-small drop-down-icon"></i>
              </div>
              <div class="dropdown-menu dropdown-head">
                <a href="">Design One</a>
                <a href="">Design Two</a>
                <a href="">Design Three</a>
                <a href="">More <i class="fas fa-arrow-right"></i> </a>
              </div>
            </div>

            <div href="#" class="dropdown">
              <div class="dropdown-head nav-link">
                <span class="text">Products </span>
                <i class="fas fa-caret-down font-size-small drop-down-icon"></i>
              </div>
              <div class="dropdown-menu dropdown-head">
                <a href="#">CV Maker</a>
                <a href="#">Digital Marketing</a>
                <a href="#">Web Design</a>
              </div>
            </div>
          </div>
        </div>
        <div class="nav-menu-foot mobile">
          <div class="nav flex start mb-1">
            <h4>Top Brands</h4>
            <button class="btnB close-nav-menu">
              <i class="fas fa-angle-double-right"></i>
            </button>
          </div>
          <div class="grid-container">
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
          </div>
          <div class="accessories nav flex start mt-2">
            <h4>Accessories/Parts</h4>
            <button class="btnB close-nav-menu">
              <i class="fas fa-angle-double-right"></i>
            </button>
          </div>
          <div class="grid-container">
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
          </div>
        </div>
      </div>
    </nav>

    <div class="header-actions">
      <div class="actions flex">
        <button class="theme-btn btnB white">
          <i class="fas fa-sun"></i>
        </button>
        <div class="search-component">
          <button class="search-btn btnB white">
            <i class="fas fa-search"></i>
          </button>
          <div class="search-action">
            <form action="/module">
              <label for="search">Search </label>
              <div class="form-group flex relative">
                <i class="fas fa-search icon-seach"></i>
                <input class="search-module flex-1" type="search" name="keyword" id="search"
                  placeholder="Search our collections" />
                <button class=" search-module">Go</button>
              </div>
            </form>
          </div>
        </div>
        <button class="nav-menu-btn btnB mobile ml-1 white">
          <i class="fas fa-bars"></i>
        </button>
        <?php if (!isset($_SESSION['user']['name'])) : ?>
        <div class="flex gap-x">
          <a href="/login" class="btn btn-s" style="color: #fff; border-color: #fff">Login</a>
          <a href="/register" class="btn btn-p">Signup</a>
        </div>
        <?php else : ?>
        <button class="notification-btn btnB white">
          <i class="fas fa-bell"></i>
        </button>
        <?php include_once "profile-links.php"; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>