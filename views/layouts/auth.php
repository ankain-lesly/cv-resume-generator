<?php include_once __DIR__ . "/../globals/globals.php"; ?>
<title>Account Registration | Resume</title>
<link rel="stylesheet" href="/static/styles/register.css" />
</head>

<body>
  <!-- <button class="btn btn-s start-resume">Open</button> -->
  <div class="root">
    <header class="main-header">
      <div class="container gap-2 flex between header-h">
        <a href="/" class="flex gap-x btn">
          <img src="/static/media/logo.png" alt="Logo" width="30px" />
          <h1 class="main-header-title">
            <small class="">Resume</small>
          </h1>
        </a>

        <a href="/" class="btn btn-s flex gap-1 back-btn white">
          <i class="fas fa-arrow-left"></i>
          Back
        </a>
      </div>
    </header>
    <main class="register">
      <div class="layout-items">
        <div class="form-container layout">
          <!-- LAYOUT -->
          <div class="reg_avater">
            <img src="/static/media/user.png" alt="Avater" class="img-cover">
          </div>
          {{content}}

        </div>
        <div class="meta layout">
          <div>
            <h3>Resume Generator</h3>
            <br>
            <p>Create and mange resumes effectively. Using our free resume generator tools your are good to go. <span
                class="clr-danger">Get started by creating your account</span></p>
            <br>
            <br>
            <p><i class="fas fa-arrow-right pr-2"></i> Signup | Login</p>
            <p><i class="fas fa-arrow-right pr-2"></i> Reset password</p>
            <p><i class="fas fa-arrow-right pr-2"></i> Create and manage Resumes</p>
            <p><i class="fas fa-arrow-right pr-2"></i> Download Resumes</p>
            <br>
            <div class="grid">
              <div class="item flex column">
                <p class="text">Not a user</p>
                <a href="/account/signup" class="bbtn secondary small"> Signup </a>
              </div>
              <div class="item flex column">
                <p class="text">Have an Account</p>
                <a href="/account/login" class="bbtn secondary small"> Login </a>
              </div>
              <div class="item flex column">
                <p class="text">Forgotten Password</p>
                <a href="/account/reset-password" class="bbtn secondary small"> Reset now </a>
              </div>
              <div class="item flex column">
                <p class="text">Have no Issue</p>
                <a href="/app/?create=resume" class="bbtn secondary small"> Create Resume </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php include_once __DIR__ . "/../globals/toast-module.php"; ?>
  </div>
  <script src="/static/scripts/jQuery.min.js"></script>
  <script type="module" src="/static/scripts/auth.js"></script>
</body>

</html>