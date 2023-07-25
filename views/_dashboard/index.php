<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Hi, Welcome <span class="detail txt-capitalize">Username</span></h3>
    </div>
    <?php
    $cars = ['count' => 8];
    $brands = ['count' => 8];
    $parts = ['count' => 8];
    $categories = ['count' => 8];
    $years = ['count' => 8];
    $users = ['count' => 8];

    ?>
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
    <div class="feeds-nav flex between mb-2">
      <h4>My Resumes</h4>
      <span class="create_resume btn btn-pre w-fit">New CV <i class="pl-1 fas fa-plus"></i></span>
    </div>
    <div class="feeds-container">

      <!-- FEED -->
      <div class="feed books-feed">
        <div class="box">
          <div class="overlay"></div>
          <div class="head flex between">
            <a href="#" class="" onclick="return confirm('Do you want to delete!')"><i class="fas fa-trash"></i></a>
            <span class="count clr-danger">1</span>
          </div>
          <div class="content mb-2 mt-2">
            <h3 class="mb-1">Tile of my resume</h3>
            <p>Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, dolore.</p>
          </div>
          <div class="foot flex between">
            <h2 class="clr-warning">App 13</h2>
            <a href="#" class="btn btn-p">Open</i></a>
          </div>
        </div>
      </div>
      <!-- FEED -->
      <div class="feed books-feed">
        <div class="box">
          <div class="overlay"></div>
          <div class="head flex between">
            <a href="#" class="" onclick="return confirm('Do you want to delete!')"><i class="fas fa-trash"></i></a>
            <span class="count clr-danger">1</span>
          </div>
          <div class="content mb-2 mt-2">
            <h3 class="mb-1">Tile of my resume</h3>
            <p>Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, dolore.</p>
          </div>
          <div class="foot flex between">
            <h2 class="clr-warning">Jun 25</h2>
            <a href="#" class="btn btn-p">Open</i></a>
          </div>
        </div>
      </div>
      <!-- FEED -->
      <div class="feed books-feed">
        <div class="box">
          <div class="overlay"></div>
          <div class="head flex between">
            <a href="#" class="" onclick="return confirm('Do you want to delete!')"><i class="fas fa-trash"></i></a>
            <span class="count clr-danger">1</span>
          </div>
          <div class="content mb-2 mt-2">
            <h3 class="mb-1">Tile of my resume</h3>
            <p>Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, dolore.</p>
          </div>
          <div class="foot flex between">
            <h2 class="clr-warning">Jun 11</h2>
            <a href="#" class="btn btn-p">Open</i></a>
          </div>
        </div>
      </div>
      <!-- FEED -->
      <div class="feed books-feed">
        <div class="box">
          <div class="overlay"></div>
          <div class="head flex between">
            <a href="#" class="" onclick="return confirm('Do you want to delete!')"><i class="fas fa-trash"></i></a>
            <span class="count clr-danger">1</span>
          </div>
          <div class="content mb-2 mt-2">
            <h3 class="mb-1">Tile of my resume</h3>
            <p>Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, dolore.</p>
          </div>
          <div class="foot flex between">
            <h2 class="clr-warning">Jan 25</h2>
            <a href="#" class="btn btn-p">Open</i></a>
          </div>
        </div>
      </div>
      <!-- <div class="feed"><div class="box">f</div></div> -->
    </div>
  </div>

</main>