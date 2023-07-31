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
          <img src="/static/media/imac-online-cv-builder-cv-template.png" alt="Logo" width="30px" />
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
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="/static/scripts/jQuery.min.js"></script>
  <script type="module" src="/static/scripts/auth.js"></script>
</body>

</html>