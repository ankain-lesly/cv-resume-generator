<?php include_once __DIR__ . "/../globals/dash-headTags.php"; ?>
</head>

<body>
  <div id="root">
    <div class="dashboard-main">
      <div class="container">
        <?php include_once __DIR__ . "/../globals/dash-sideNav.php"; ?>
        <section class="main-content">
          <?php include_once __DIR__ . "/../globals/dash-header.php"; ?>

          <!-- Page View Start -->
          {{content}}
          <!-- Page View Ends -->

        </section>
      </div>
    </div>
    <?php include_once __DIR__ . "/../globals/dash-footer.php"; ?>
  </div>

  <script src="/static/scripts/jQuery.min.js"></script>
  <script src="/static/scripts/create.js"></script>
</body>

</html>