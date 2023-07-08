
  <div class="main-container">
    <!-- partial:index.partial.html -->
    <div class="container">
      <svg class="form-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
        viewbox="0 0 640 480" xml:space="preserve">
        <g transform="matrix(3.31 0 0 3.31 320.4 240.4)">
          <circle
            style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(61,71,133); fill-rule: nonzero; opacity: 1;"
            cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.98 0 0 0.98 268.7 213.7)">
          <circle
            style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
            cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(1.01 0 0 1.01 362.9 210.9)">
          <circle
            style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
            cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.92 0 0 0.92 318.5 286.5)">
          <circle
            style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
            cx="0" cy="0" r="40"></circle>
        </g>
        <g transform="matrix(0.16 -0.12 0.49 0.66 290.57 243.57)">
          <polygon
            style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
            points="-50,-50 -50,50 50,50 50,-50 "></polygon>
        </g>
        <polygon
          style="stroke: rgb(0,0,0); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
          vector-effect="non-scaling-stroke" points="-50,-50 -50,50 50,50 50,-50 "></polygon>
        <g transform="matrix(0.16 0.1 -0.44 0.69 342.03 248.34)">
        </g>
      </svg>
      <div class="screen-1">
        <p class="txt-center">Create an account</p>
        <form method="post">
          <?php
          if (isset($user['errors']))
            echo '<div class="form-error">' . $user['errors'][0] . '</div>';
          ?>
          <div class="form-group">
            <label for="username">Username</label>
            <div class="sec-2 flex">
              <i class="fas fa-user"></i>
              <input type="text" class="flex-1" name="username" id="username" placeholder="username"
                value="<?= isset($user['data']) ? $user['data']['username'] : '' ?>" required />
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <div class="sec-2 flex">
              <i class="fas fa-envelope"></i>
              <input type="email" class="flex-1" name="email" id="email" placeholder="Username@gmail.com"
                value="<?= isset($user['data']) ? $user['data']['email'] : '' ?>" required />
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="phone">Phone number</label>
            <div class="sec-2 flex">
              <i class="fas fa-phone"></i>
              <input type="tel" class="flex-1" name="phone" id="phone" placeholder="Mobile.."
                value="<?= isset($user['data']) ? $user['data']['phone'] : '' ?>" required />
            </div>
          </div> -->
          <div class="password form-group">
            <label for="password">Password</label>
            <div class="sec-2 flex">
              <i class="fas fa-lock"></i>
              <input class="pas flex-1" type="password" name="password" id="password" placeholder="Enter password"
                required />
              <i class="fas fa-eye show-hide"></i>
            </div>
          </div>
          <div class="password form-group">
            <label for="confirm_password">Confirm password</label>
            <div class="sec-2 flex">
              <i class="fas fa-lock"></i>
              <input class="pas flex-1" type="password" name="confirm_password" id="confirm_password"
                placeholder="Confirm password" required />
              <i class="fas fa-eye show-hide"></i>
            </div>
          </div>
          <button class="login-btn" name="signup">Signup </button>

        </form>
      </div>
      <div class="footer flex gap-1">
        <span>Already have account?</span>
        <a href="/login.php?v=login">Login</a>
      </div>
    </div>
  </div>