<main>
  <!-- Page View Start -->
  <div class="dashboard">
    <div class="mini-head">
      <h3>Resumes </h3>
    </div>
    <br>
    <div class="feeds-nav flex between mb-2" id="resumes">
      <h4>Recent Resumes</h4>
      <span class="create_resume btn btn-pre w-fit">Add Resume <i class="pl-1 fas fa-plus"></i></span>
    </div>
    <div class="feeds-container">
      <?php if ($metadata) :
        foreach ($metadata as $key => $data) { ?>
          <!-- FEED -->
          <div class="feed books-feed">
            <div class="box">
              <div class="overlay"></div>
              <div class="head flex between">
                <!-- <a href="#" class="clr-bg" onclick="return confirm('Do you want to delete!')"><i -->
                <a href="#" class="clr-bg"><i class="fas fa-trash"></i></a>
                <span class="count clr-danger">1</span>
              </div>
              <div class="content mb-2 mt-2">
                <div class="cfx flex start gap-x top">
                  <span class="font-size-small fas fa-pencil-alt padd edit_title"></span>
                  <h3 class="mb-1 title"><?= $data['title'] ?></h3>
                </div>
                <div class="cfx flex start gap-x top">
                  <span class="font-size-small fas fa-pencil-alt padd edit_description"></span>
                  <p class="description"><?= $data['description'] ?></p>
                </div>
                <input type="hidden" value="<?= $data['meta_id'] ?>" id="content_meta">
              </div>
              <div class="foot flex between">
                <p class="clr-warning"><?= date("M j, h a", strtotime($data['created_on'])) ?></p>
                <a href="/resume/edit/<?= $data['resume_id'] ?>" class="btn btn-p">Open</i></a>
              </div>
            </div>
          </div>
        <?php }
      else : ?>

        <!-- FEED -->
        <div class="feed books-feed">
          <div class="box">
            <div class="overlay"></div>
            <div class="head flex between">
              <a href="#" class=""><i class="fas fa-trash"></i></a>
              <span class="count clr-danger">1</span>
            </div>
            <div class="content mb-2 mt-2">
              <div class="cfx flex start gap-x top">
                <span class="font-size-small fas fa-pencil-alt padd edit_title"></span>
                <h3 class="mb-1 title">Resume title here</h3>
              </div>
              <div class="cfx flex start gap-x top">
                <span class="font-size-small fas fa-pencil-alt padd edit_description"></span>
                <p class="description">Resume description... create a resume --</p>
              </div>
              <input type="hidden" value="" id="content_meta">
            </div>
            <div class="foot flex between">
              <p class="clr-warning">App 13</p>
              <a href="" onclick="alert('Please add a resume to continue. 🐱‍🏍')" class="btn btn-p px-4"><i class="fas fa-undo"></i></i></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <?php if (!$metadata) : ?>
      <div class="clr-warning txt-center">You dont have any resume in your records</div>
    <?php endif; ?>
  </div>

</main>