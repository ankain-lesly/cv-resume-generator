<!-- SIGNUP -->

<div class="main-container">
  <h2 class="mb-1 txt-center">Create account</h2>

  <!-- // Form messages -->
  <div class="form-message shake_anim" id="form-message"></div>

  <form id="signup_form">
    <!-- // username -->
    <div class="form-group flex gap-x">
      <label for="username" class="icon">
        <i class="fas fa-user"></i>
      </label>
      <input type="text" id="username" placeholder="Username " autocomplete="on" />
      <label for="username" class="status-msg shake_anim"></label>
      <label class="fas fa-info info"></label>
    </div>

    <!-- // Email -->
    <div class="form-group flex gap-x">
      <label for="email" class="icon">
        <i class="fas fa-envelope"></i>
      </label>
      <input type="email" id="email" placeholder="Email address" autocomplete="on" />
      <label for="email" class="status-msg shake_anim"></label>
      <label class="fas fa-info info"></label>
    </div>

    <!-- // Phone -->
    <div class="form-group flex gap-x">
      <label for="phone" class="icon">
        <i class="fas fa-phone"></i>
      </label>
      <input type="tel" id="phone" placeholder="Phone number (optional)" autocomplete="on" />
      <label for="phone" class="status-msg shake_anim"></label>
      <label class="fas fa-info info"></label>
    </div>

    <!-- // Password -->
    <div class="form-group flex gap-x">
      <label for="password" class="icon">
        <i class="fas fa-lock"></i>
      </label>
      <input type="password" id="password" placeholder="Password" autocomplete="on" />
      <label for="password" class="status-msg shake_anim"></label>
      <label data-toggle-type="#password" for="password" title="toggle visibility" class="fas fa-eye">
      </label>
    </div>

    <!-- // Confirm password -->
    <div class="form-group flex gap-x">
      <label for="confirm_password" class="icon">
        <i class="fas fa-lock"></i>
      </label>
      <input type="password" id="confirm_password" placeholder="confirm_password" autocomplete="on" />
      <label for="confirm_password" class="status-msg shake_anim"></label>
      <label data-toggle-type="#confirm_password" for="confirm_password" title="toggle visibility" class="fas fa-eye">
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
      <span class="me">Already have account</span>
      <a href="/account/login" class="clr-danger ml-1">Sign Up</a>
    </div>
  </form>
</div>