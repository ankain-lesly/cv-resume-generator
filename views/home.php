    <div class="hero-container">
      <div class="hero-banner section-p">
        <div class="container-x flex">
          <div class="content">
            <h2><span class="clr-warning">Resume Generator</span><br> Be the host of your creativity</h2>
            <p>Showcase your knowledge, your skills, experience, expertise, and accomplishments. A resume the best place
              to start.</p>
            <h5 class="captions flex gap-x start">
              <small class="detail"><i class="fas fa-angle-double-left"></i></small>
              <small class="detail">Popular</small>
              <small class="detail">Most used</small>
              <small class="detail">latest</small>
              <small class="detail"><i class="fas fa-angle-double-right"></i></small>
            </h5>
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
        <h2>Lets Get Started</h2>
        <div class="procedures section-p">
          <div class="step-item">
            <div class="icon">1</div>
            <div class="content">
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A ut voluptate id.</p> -->
              <p>Create your account to get started</p>
            </div>
            <div class="actions">
              <a href="/register.php" class="btn btn-p clr-white">Create Account <i class="fas fa-user"></i></a>
            </div>
          </div>
          <div class="step-item">
            <div class="icon">2</div>
            <div class="content">
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A ut voluptate id.</p> -->
              <p>Select a resume template and enter the required Resume information</p>
            </div>
            <div class="actions">
              <a href="#" class="btn btn-p clr-white">Template <i class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
          <div class="step-item">
            <div class="icon">3</div>
            <div class="content">
              <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A ut voluptate id.</p> -->
              <p>Download your CV in PDF or DOCX Formats</p>
            </div>
            <div class="actions">
              <a href="" class="btn btn-p clr-white">Downlaod<i class="fas fa-download"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- // TEMPLATES -->
    <section id="templates">
      <h2 class="txt-center">Recent Templates</h2>
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