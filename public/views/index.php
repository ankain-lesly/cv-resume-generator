<?php
include_once "./static/globals/head-tags.php";
?>
</head>

<body>
  <div class="root">
    <div class="hero-container">
      <!-- HEADER -->
      <?php include_once "./static/globals/header.php"; ?>
      <!-- HERO -->
      <div class="hero-banner section-p">
        <div class="container-x flex">
          <div class="content">
            <h2><span class="clr-warning">HND</span> - CV Maker <br> Be the host of your creativity</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis a, quidem impedit deserunt harum
              corporis?</p>
            <h5 class="captions flex gap-x start">
              <small class="detail"><i class="fas fa-angle-double-left"></i></small>
              <small class="detail">Popular</small>
              <small class="detail">Most used</small>
              <small class="detail">latest</small>
              <small class="detail"><i class="fas fa-angle-double-right"></i></small>
            </h5>
          </div>
          <div class="media">
            <img src="/static/media/imac-online-cv-builder-cv-template.png" alt="Welcome cart item" style="max-height: 460px;">
          </div>
        </div>
      </div>
    </div>
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

    <?php include_once "./static/globals/footer.php"; ?>
</body>

</html>