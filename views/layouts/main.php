<?php
include_once __DIR__."/../globals/main-headTags.php";
?>
</head>

<body>
  <div class="root">
    <div class="hero-container">
      <!-- HEADER -->
      <?php include_once __DIR__."/../globals/header.php"; ?>
      <!-- HERO -->
      
      {{content}}

    <?php include_once __DIR__."/../globals/footer.php"; ?>
  </div>
<!-- // Demo Scripts -->
<script src="/static/scripts/jQuery.min.js"></script>
<script src="/static/scripts/home.js"></script>
</body>

</html>