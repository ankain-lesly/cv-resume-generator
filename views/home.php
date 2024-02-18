<div class="hero-container landing">
  <div class="hero-bg">
    <img src="/static/media/_shapes-mac-tab.png" alt="">
  </div>
  <div class="hero-banner section-p">
    <div class="container-x flex" style="justify-content: space-between;">
      <div class="content">
        <div style="max-width: 480px;">
          <h1>Be the host of your creativity with our resume generator</h1>
          <p>Showcase your knowledge, your skills, experience, expertise, and accomplishments. A resume the best
            place
            to start.</p>

          <a href="#resume" class="bbtn secondary">Start For Free</a>
          <br>
          <br>
          <h5 class="captions flex gap-x start">
            <small class="detail"><i class="fas fa-angle-double-left"></i></small>
            <small class="detail">Popular</small>
            <small class="detail">Most used</small>
            <small class="detail">latest</small>
            <small class="detail"><i class="fas fa-angle-double-right"></i></small>
          </h5>
        </div>
      </div>
      <div class="media">
        <img src="/static/media/logo.png" alt="Welcome cart item" style="max-height: 460px;">
      </div>
    </div>
  </div>
</div>
<!-- // rESUME STEPS -->
<section class="steps">
  <div class="container-x section-p">
    <h1 class="">Lets Get Started</h1>
    <p class="caption">Ready to take your resume to the next level. Follow the steps below to begin</p>
    <div class="procedures section-p">
      <div class="step-item">
        <div class="icon">1</div>
        <div class="content">
          <p class="clr-light">Firstly Create your account to keep track of data and created resource. Or try out the free option</p>
        </div>
        <div class="actions">
          <!-- <a href="/register.php" class="clr-warning">Create Account <i class="fas fa-user"></i></a> -->
          <a href="/register.php" class="clr-warning">Create Account </a>
        </div>
      </div>
      <div class="step-item">
        <div class="icon">2</div>
        <div class="content">
          <p class="clr-light">Next Select a resume template of your choice and fill the required information</p>
        </div>
        <div class="actions">
          <!-- <a href="#" class="clr-warning">Template <i class="fas fa-angle-double-right"></i></a> -->
          <a href="#" class="clr-warning">Template </a>
        </div>
      </div>
      <div class="step-item">
        <div class="icon">3</div>
        <div class="content">
          <p class="clr-light">Download your CV in PDF or DOCX Formats</p>
        </div>
        <div class="actions">
          <!-- <a href="" class="clr-warning">Downlaod<i class="fas fa-download"></i></a> -->
          <a href="" class="clr-warning">Downlaod</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- // TEMPLATES -->
<section id="templates">
  <h1 class="txt-center">Recent Templates</h2>
    <p class="caption">Here is a collection of our recently created resume templates ready for use</p>

    <div class="design-container section-p container-x">
      <div class="main">
        <!-- FEEDs -->
        <?php foreach ($templates as $data) { ?>
          <div class="item">
            <img src="/resumes/thumbnails/<?= $data['thumbnail'] ?>" class="img-cover" alt="Design">
            <div class="options py-1 px-x">
              <a href="/app/create/resume/<?= $data["template_id"] ?>/?x-status=new&basis=no-auth" class="bbtn secondary small use_template">
                Use Template <i class="pl-1 fas fa-angle-double-right"></i>
              </a>
              <input type="hidden" value="<?= $data["template_id"] ?>" id="use_main">
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
</section>
<!-- // Another -->
<section id="another">
  <div class="contain-x section-p"></div>
</section>