<?php
include_once __DIR__ . "/../globals/main-headTags.php";
?>
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
  <script src="/static/scripts/home.js"></script>
</body>

</html>