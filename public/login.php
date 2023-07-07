<?php
include_once __DIR__ . "/connect/Controllers/UserController.php";

use App\Controllers\UserController;

if (isset($_POST['login'])) {
  $user = (new UserController)->login();

  if ($user === false) {
    $user['errors'] = ['Invalid Login credentialss'];
    $user['data'] = ['email' => $_POST['email']];
  }
  // // exit();
}
?>
<?php include_once "./static/globals/globals.php"; ?>
<title>Create Account - HND CV Maker</title>
<link rel="stylesheet" href="/static/css/register.css">
</head>

<body>
  <div class="nav">
    <div class="container-x flex between header-h">
      <a href="/" class="btn btn-s"><i class="fas fa-arrow-left pr-1"></i></a>
    </div>
  </div>
  <div class="main-container">
    <!-- partial:index.partial.html -->
    <div class="container">
      <svg class="form-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewbox="0 0 640 480" xml:space="preserve">
        <g transform="matrix(3.31 0 0 3.31 320.4 240.4)">
          <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(61,71,133); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.98 0 0 0.98 268.7 213.7)">
          <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(1.01 0 0 1.01 362.9 210.9)">
          <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.92 0 0 0.92 318.5 286.5)">
          <circle style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.16 -0.12 0.49 0.66 290.57 243.57)">
          <polygon style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" points="-50,-50 -50,50 50,50 50,-50 "></polygon>
        </g>
        <g transform="matrix(0.16 0.1 -0.44 0.69 342.03 248.34)">
          <polygon style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke" points="-50,-50 -50,50 50,50 50,-50 "></polygon>
        </g>
      </svg>
      <div class="screen-1">
        <p class="txt-center">Login to your account</p>
        <form method="post">
          <?php
          if (isset($user['errors']))
            echo '<div class="form-error">' . $user['errors'][0] . '</div>';
          ?>
          <div class="form-group">
            <label for="email">Email Address</label>
            <div class="sec-2 flex">
              <i class="fas fa-envelope"></i>
              <input type="email" class="flex-1" name="email" id="email" placeholder="example@gmail.com" value="<?= isset($user['data']) ? $user['data']['email'] : '' ?>" required />
            </div>
          </div>
          <div class="password form-group">
            <div class="label-group flex between">
              <label for="password">Password</label>
              <a href="/register.php?v=reset"><small>Forgot Password?</small></a>
            </div>
            <div class="sec-2 flex">
              <i class="fas fa-lock"></i>
              <input class="pas flex-1" type="password" name="password" id="password" placeholder="············" required />
              <i class="fas fa-eye show-hide"></i>
            </div>
          </div>
          <button class="login-btn" name="login">Login </button>

        </form>
      </div>
      <div class="footer flex gap-1">
        <span>Already have account?</span>
        <a href="/register.php?v=signup">Singup</a>
      </div>
    </div>
  </div>

  <!-- partial -->
  <script src="/static/js/jQuery.min.js"></script>
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