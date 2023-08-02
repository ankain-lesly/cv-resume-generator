<!-- LOGIN -->

<div class="main-container">
  <h2 class="mb-1 txt-center">Login</h2>

  <!-- // Form messages -->
  <div class="form-message shake_anim" id="form-message">Hi lee testing this</div>

  <form id="login_form">
    <!-- // username -->
    <div class="form-group flex gap-x">
      <label for="username" class="icon">
        <i class="fas fa-user"></i>
      </label>
      <input type="text" id="username" placeholder="Username or Email" autocomplete="on" />
      <label for="username" class="status-msg shake_anim"></label>
      <label class="fas fa-info info"></label>
    </div>
    <!-- // Passwird -->
    <div class="form-group flex gap-x">
      <label for="password" class="icon">
        <i class="fas fa-lock"></i>
      </label>
      <input type="password" id="password" placeholder="Password" autocomplete="on" />
      <label for="password" class="status-msg shake_anim"></label>
      <label data-toggle-type="#password" for="password" title="toggle visibility" class="fas fa-eye visibility">
      </label>
    </div>

    <!-- Remember me  -->
    <div class="group">
      <input type="checkbox" id="keep_alive" />
      <label for="keep_alive">Remember me</label>
    </div>

    <button class="flex mt-2 mb-2 form_btn" type="submit">
      <span class="mr-1 p-main"> Login </span>
      <i class="fas fa-arrow-right p-main"></i>
      <span class="p-odd mr-1">Processing...</span>
      <span class="p-odd loader inline-text mr-1"></span>
    </button>

    <div class="txt-center">
      <span class="me">Don't have an account</span>
      <a href="/account/signup" class="clr-danger ml-1">Sign Up</a>
    </div>
  </form>
</div>