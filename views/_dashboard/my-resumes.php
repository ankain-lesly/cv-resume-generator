<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Resumes, <span class="detail txt-capitalize">Username</span></h3>
    </div>
    <br>
    <div class="feeds-nav flex between mb-2" id="resumes">
      <h4>Recent Resumes</h4>
      <span class="create_resume btn btn-pre w-fit">New CV <i class="pl-1 fas fa-plus"></i></span>
    </div>
    <div class="feeds-container">
      <?php
      foreach ($metadata as $key => $data) { ?>
      <!-- FEED -->
      <div class="feed books-feed">
        <div class="box">
          <div class="overlay"></div>
          <div class="head flex between">
            <a href="#" class="" onclick="return confirm('Do you want to delete!')"><i class="fas fa-trash"></i></a>
            <span class="count clr-danger">1</span>
          </div>
          <div class="content mb-2 mt-2">
            <h3 class="mb-1"><?= $data['title'] ?></h3>
            <p><?= $data['description'] ?></p>
          </div>
          <div class="foot flex between">
            <p class="clr-warning">App 13</p>
            <a href="/resume/create/<?= $data['resume_id'] ?>" class="btn btn-p">Open</i></a>
          </div>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>

</main>