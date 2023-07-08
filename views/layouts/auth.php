<?php include_once __DIR__."/../globals/globals.php"; ?>
<title>Create Account - HND CV Maker</title>
<link rel="stylesheet" href="/static/css/register.css">
</head>

<body>
  <div class="nav">
    <div class="container-x flex between header-h">
      <a href="/" class="btn btn-s"><i class="fas fa-arrow-left pr-1"></i></a>
    </div>
  </div>

  {{content}}

  <!-- partial -->
  <script src="/static/scripts/jQuery.min.js"></script>
  <script>
    $('.show-hide').on("click", function(e) {
      let inputEl = $(this).siblings('input');
      let inputType = inputEl.attr('type') === 'password' ? 'text' : 'password';
      let icon = inputEl.attr('type') === 'type' ? 'fas fa-eye' : 'fas fa-eye-slash';

      inputEl.attr('type', inputType);
      $(this).attr('class', icon);
    })
  </script>
</body>

</html>