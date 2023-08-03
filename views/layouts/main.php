<?php include_once __DIR__ . "/../globals/globals.php" ?>
<title>Awesome Home | HND Resume Maker</title>
<link rel="stylesheet" href="/static/styles/style.css" />
</head>

<body>
  <div class="root">
    <!-- HEADER -->
    <?php include_once __DIR__ . "/../globals/header.php"; ?>
    <!-- CONTENT -->

    {{content}}

    <!-- FOOTER -->
    <?php include_once __DIR__ . "/../globals/footer.php"; ?>
  </div>
  <!-- // Scripts -->
  <script src="/static/scripts/jQuery.min.js"></script>
  <script type="module" src="/static/scripts/home.js"></script>
</body>

</html>