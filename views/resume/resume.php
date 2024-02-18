  <?php include_once __DIR__ . "/../globals/globals.php" ?>
  <title><?= $resume['title'] ?? "Untitled" ?> | Resume Maker</title>
  <link rel="stylesheet" href="/static/styles/create.css" />
  <style type="text/css">
    #my_resume_wrapper {
      margin: auto;
      overflow: hidden;
      margin: auto;
      width: 100%;
      max-width: 550px;
      border-radius: 0.5em;
      box-shadow: 1px 2px 20px #333;
      cursor: zoom-in;
    }

    #my_resume_main {
      width: var(--design-width);
      transform-origin: 0 0;
    }

    /*// Loader*/
    #page_loader {
      position: fixed;
      width: 100vw;
      z-index: 20000;
      top: 0;
      left: 0;
      height: 100%;
    }

    .loading {
      background: #fff;
      transition: .1s ease opacity;
      -webkit-transition: .1s ease opacity;
    }

    .loading .spinner {
      width: 70px;
      text-align: center;
      position: fixed;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }

    .loading .spinner>div {
      width: 18px;
      height: 18px;
      background-color: #333;
      border-radius: 100%;
      display: inline-block;
      -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
      animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }

    .loading .spinner .bounce1 {
      -webkit-animation-delay: -0.32s;
      animation-delay: -0.32s;
    }

    .loading .spinner .bounce2 {
      -webkit-animation-delay: -0.16s;
      animation-delay: -0.16s;
    }

    @-webkit-keyframes sk-bouncedelay {

      0%,
      80%,
      100% {
        -webkit-transform: scale(0)
      }

      40% {
        -webkit-transform: scale(1.0)
      }
    }

    @keyframes sk-bouncedelay {

      0%,
      80%,
      100% {
        -webkit-transform: scale(0);
        transform: scale(0);
      }

      40% {
        -webkit-transform: scale(1.0);
        transform: scale(1.0);
      }
    }

    #page_loader.loaded {
      display: none !important;
    }

    #page_loader .layer_content {
      background-color: rgba(0, 0, 0, 0.4);
      padding: 0 1rem;
    }

    #page_loader .sync,
    #page_loader .content {
      background-color: var(--clr-white);
      border-radius: 0.35em;
    }

    #page_loader .sync {
      padding: 0.5em 1em;
      color: var(--clr-bg);
      font-size: 0.8rem;
      box-shadow: 6px 10px 28px 0px rgba(0, 0, 0, 0.4);
    }

    #page_loader .layer_preview {
      box-shadow: 6px 10px 28px 0px rgba(0, 0, 0, 0.4);
      background-color: var(--clr-white);
      /*color: var(--clr-bg);*/
      cursor: alias;
    }


    #page_loader .content h2 {
      border-bottom: 2px solid var(--clr-text-muted);
      text-align: left;
      padding-bottom: 0.5rem;
    }

    #page_loader .content p {
      font-size: 1.1rem;
    }


    #page_loader.alert-unsigned {
      display: none;
      background-color: hsla(var(--hsl-color-bg), 0.8);
    }

    #page_loader.alert-unsigned.show {
      display: flex;
    }

    .base-actions {
      position: fixed;
      bottom: 1.5rem;
      right: 2rem;

    }

    .btn_main_dd {
      background: blue;
      width: 50px;
      height: 50px;
      line-height: 35px;
      box-sizing: var(--bs);
      text-align: center;
      color: #fff;
      border-radius: 50%;
      display: none;
    }

    @media (min-width: 750px) {
      .btn_preview {
        display: none;
      }

      .btn_main_dd {
        display: block;
      }
    }
  </style>
  </head>

  <body>
    <div class="root">
      <div class="create-resume">
        <header class="main-header flex between gap-1">
          <a href="/app/" class="flex gap-x">
            <small class="fas fa-arrow-left" style="color: #fff"></small>
            <img src="/static/media/logo.png" alt="Logo" width="25px">
          </a>

          <div class="title flex-1 txt-center" style="overflow: hidden">
            <!-- on_edit -->
            <div class="resume_title flex gap-x">
              <p class="txt-ellipsis clr-dark txt-capitalize"><?= $resume['title'] ?? "Untitled" ?> | Resume</p>
              <input type="hidden" id="update_title" value="Untitled">
              <button class="fas fa-pencil-alt font-size-small"></button>
            </div>
          </div>

          <div class="actions flex gap-1">
            <button class="bbtn primary flex gap-x btn_clear" onclick="return confirm('Do you want to reset all form data?')">
              <span class="spin loader inline-text"></span>
              <i class="icon fas fa-trash"></i>
              <span class="txt">Reset</span>
            </button>
            <button class="bbtn primary flex gap-x btn_save_resume">
              <span class="spin loader inline-text"></span>
              <i class="icon fas fa-save"></i>
              <span class="txt">Save</span>
            </button>
            <button class="bbtn primary flex gap-x option">
              <span class="spin loader inline-text"></span>
              <span class="pr-1 txt">CV</span> <i class="icon fas fa-caret-down"></i>
            </button>
            <button class="bbtn secondary pre flex gap-x btn_resume_dd">
              <span class="spin loader inline-text"></span>
              <i class="icon fas fa-download"></i>
              <span class="txt pl-x">Download</span>
            </button>
          </div>
        </header>
        <div id="page_loader" class="loading">
          <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
          </div>
        </div>
        <main class="container-main">
          <!-- create Forms -->
          <section class="create-form">
            <div class="side_panel">
              <button class="btn_close_panel btn_panel" title="close side panel">
                <i class="fas fa-angle-double-left"></i>
              </button>
              <ul class="actions_lists">
                <li data-target="create_forms" class="panel_action panel_btn active">
                  <i class="fas fa-pencil-alt icon"></i>
                  <p class="text">Create</p>
                </li>
                <li data-target="templates" class="panel_action panel_btn">
                  <i class="fas fa-edit icon"></i>
                  <p class="text">Templates</p>
                </li>
                <li data-target="settings" class="panel_action panel_btn">
                  <i class="fas fa-greater-than icon"></i>
                  <p class="text">Settings</p>
                </li>
                <li data-target="content" class="panel_action panel_btn">
                  <i class="fas fa-radiation icon"></i>
                  <p class="text">Content</p>
                </li>
                <li class="panel_action btn_save_resume">
                  <i class="fas fa-save icon"></i>
                  <p class="text">Save</p>
                </li>
                <li class="theme-btn flex gap-x">
                  <i class="fas fa-moon icon _theme_icon"></i>
                  <span class="text _theme_text txt-capitalize"> Dark</span>
                </li>
              </ul>
              <br><br><br>
            </div>
            <div class="main_content pages">
              <div class="head">
                <button class="btn_close_panel btn_panel flex gap-1 clr-warning" title="close side panel">
                  <i class="fas fa-angle-double-right"></i>
                  <small class="text"> sidebar</small>
                </button>
              </div>
              <!-- // CREATE -->
              <div class="create_forms page_section on_page">
                <div class="intro mb-1">
                  <h3 class="">Create resume</h3>
                  <!-- <small>Select a section form below to</small> -->
                  <div class="resume_info" style="display: none">
                    <input type="hidden" id="resume_main" value="<?= $resume['resume_id'] ?>" />
                    <input type="hidden" id="template_main" value="<?= $resume['template_id'] ?>" />
                  </div>
                </div>
                <div class="container actions flex wrap start gap-1">
                  <button data-form-section="personal" class="control_action">
                    <i class="fas fa-user icon"></i>
                    <span class="text">Personal</span>
                  </button>
                  <button data-form-section="education" class="control_action">
                    <i class="fas fa-graduation-cap icon"></i>
                    <span class="text">Eduction</span>
                  </button>
                  <button data-form-section="experience" class="control_action">
                    <i class="fas fa-briefcase icon"></i>
                    <span class="text">Work experience</span>
                  </button>
                  <button data-form-section="social" class="control_action">
                    <i class="fas fa-globe icon"></i>
                    <span class="text">Social media</span>
                  </button>
                  <button data-form-section="skill" class="control_action">
                    <i class="fas fa-tasks icon"></i>
                    <span class="text">Skills</span>
                  </button>
                  <button data-form-section="language" class="control_action">
                    <i class="fas fa-language icon"></i>
                    <span class="text">Languages</span>
                  </button>
                  <button data-form-section="hobby" class="control_action">
                    <i class="fas fa-star icon"></i>
                    <span class="text">Hobbies</span>
                  </button>
                  <button data-form-section="add" class="control_action">
                    <i class="fas fa-plus icon"></i>
                    <span class="text">Add Section</span>
                  </button>
                </div>
                <div class="content_display"></div>
              </div>
              <!-- // FORM CONTENT -->
              <!-- item step PERSONAL -->
              <div data-section-title="personal" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Personal Infomation</p>
                </div>
                <div class="personal">
                  <div class="form-content">
                    <!-- // Personal Details -->
                    <div class="personal-1 flex gap-2 top">
                      <div class="form-goup">
                        <input type="text" id="picture" style="display: none" data-inp-reff="picture" />
                        <input type="file" id="resume_photo" data-placeholder=".photo_placeholder" accept="images/*" />
                        <label for="resume_photo" class="picture_holder">
                          <div class="picture">
                            <img src="/static/media/user.png" class="img-cover img-cover-profile" alt="Cover Picture" />
                          </div>
                          <span class="btn_camera flex">
                            <i class="fas fa-camera"></i>
                          </span>
                        </label>
                      </div>
                      <div class="intro-group flex-1">
                        <div class="form-group">
                          <label for="firstname">First name</label>
                          <input type="text" id="firstname" data-inp-reff="firstname" />
                        </div>
                        <div class="form-group">
                          <label for="lastname">Last name</label>
                          <input type="text" id="lastname" data-inp-reff="lastname" />
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input type="text" id="address" data-inp-reff="address" />
                        </div>
                        <div class="form-group">
                          <label for="date_of_birth">Date of birth</label>
                          <input type="date" id="date_of_birth" data-inp-reff="date_of_birth" />
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-1">
                      <label for="headline">Headline</label>
                      <input type="text" id="headline" data-inp-reff="headline" />
                    </div>
                  </div>
                  <div class="form-group mb-1">
                    <label for="about">About me</label>
                    <textarea id="about" data-inp-reff="about" cols="30" rows="3"></textarea>
                  </div>
                  <div class="personal-2 intro-group">
                    <div class="form-group mb-1">
                      <label for="email">Email</label>
                      <input type="email" id="email" data-inp-reff="email" />
                    </div>
                    <div class="form-group mb-1">
                      <label for="phone">Phone number</label>
                      <input type="tel" id="phone" data-inp-reff="phone" />
                    </div>
                  </div>
                </div>
                <div class="add_extras">
                  <ul class="extras_container flex wrap gap-x">
                    <li title="Add new field"></li>
                    <li class="child" title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li class="child" title="Add new field"></li>
                    <li title="Add new field"></li>
                    <li title="Add new field"></li>
                  </ul>
                </div>
              </div>
              <!-- item step EDUCATION -->
              <div data-section-title="education" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Education</p>
                </div>
                <div class="form-content education">
                  <div class="education-main"></div>
                  <div class="actions">
                    <span data-target=".education-main" data-form-object="OBJECT_EDUCATION" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add education</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>
              <!-- item step EXPERIENCE -->
              <div data-section-title="experience" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Work Experience</p>
                </div>
                <div class="form-content experience">
                  <div class="experience-main"></div>
                  <div class="actions">
                    <span data-target=".experience-main" data-form-object="OBJECT_EXPERIENCE" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add experience</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>
              <!-- item step SKILL -->
              <div data-section-title="social" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Social Media</p>
                </div>
                <div class="form-content social">
                  <!-- CONTAINER -->
                  <div class="social-main"></div>
                  <!-- ACTIONS -->
                  <div class="actions">
                    <span data-target=".social-main" data-form-object="OBJECT_SOCIAL" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add social</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>
              <!-- item step LANGUAGE -->
              <div data-section-title="language" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Languages</p>
                </div>
                <div class="form-content language">
                  <!-- CONTAINER -->
                  <div class="language-main"></div>
                  <!-- ACTIONS -->
                  <div class="actions">
                    <span data-target=".language-main" data-form-object="OBJECT_LANGUAGE" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add Language</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>
              <!-- item step SKILL -->
              <div data-section-title="skill" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Skills</p>
                </div>
                <div class="form-content skill">
                  <!-- CONTAINER -->
                  <div class="skill-main"></div>
                  <!-- ACTIONS -->
                  <div class="actions">
                    <span data-target=".skill-main" data-form-object="OBJECT_SKILL" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add skill</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>
              <!-- item step HOBBIES -->
              <div data-section-title="hobby" class="area-step">
                <div class="head flex start">
                  <div class="icon"></div>
                  <p>Hobbies</p>
                </div>
                <div class="form-content hobby">
                  <!-- CONTAINER -->
                  <div class="hobby-main"></div>
                  <!-- ACTIONS -->
                  <div class="actions">
                    <span data-target=".hobby-main" data-form-object="OBJECT_HOBBY" class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add hobby</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>

              <div class="page_options_btn">
                <button class="btn_page_section bbtn secondary">
                  <i class="fas fa-arrow-left pr-x"></i>
                  <span class="text">Back</span>
                </button>
              </div>
              <!-- // SETTINGS  -->
              <div class="settings page_section">
                <h3 class="">Settings</h3>
                <div class="settings-component">
                  <div class="grid-items">
                    <div class="grid flex between">
                      <div class="item">Themes</div>
                      <div class="item">Fonts</div>
                      <div class="item">Pallets</div>
                      <div class="item">Margins</div>
                      <div class="item">more <i class="fas fa-arrow-right"></i></div>
                    </div>
                  </div>
                  <div class="colors">
                    <div class="form-group" data-target="resume_info">
                      <input type="color" data-ref="target" name="" id="" style="height: 100px;">
                    </div>
                    <ul class="pallet">
                      <li><span class="color" style="--hash: #00f"></span></li>
                      <li><span class="color" style="--hash: #000"></span></li>
                      <li><span class="color" style="--hash: #F20"></span></li>
                      <li><span class="color" style="--hash: #D93"></span></li>
                      <li><span class="color" style="--hash: #833"></span></li>
                      <li><span class="color" style="--hash: #e31"></span></li>
                      <li><span class="color" style="--hash: #D13"></span></li>
                      <li><span class="color" style="--hash: #3e33"></span></li>
                      <li><span class="color" style="--hash: #A88"></span></li>
                      <li><span class="color" style="--hash: #AE3"></span></li>
                      <li><span class="color" style="--hash: #C40"></span></li>
                      <li><span class="color" style="--hash: #F18"></span></li>
                      <li><span class="color" style="--hash: #4FF"></span></li>
                      <li><span class="color" style="--hash: #F3F"></span></li>
                      <li><span class="color" style="--hash: #FFF"></span></li>
                      <li><span class="color" style="--hash: #CCB"></span></li>
                      <li><span class="color" style="--hash: #FFA"></span></li>
                      <li><span class="color" style="--hash: #00f75d"></span></li>
                      <li><span class="color" style="--hash: #ff9"></span></li>
                      <li><span class="color" style="--hash: #c730a5"></span></li>
                      <li><span class="color" style="--hash: #0aff55"></span></li>
                      <li><span class="color" style="--hash: #2861cd"></span></li>
                      <li><span class="color" style="--hash: #ae67fa"></span></li>
                      <li><span class="color" style="--hash: #a283f0"></span></li>
                    </ul>
                  </div>
                </div>
                <h4 class="mt-2">Font and Typography</h4>

              </div>
              <!-- // TEMPLATES -->
              <div class="templates page_section">

                <div class="template-component">
                  <!-- FEEDs -->
                  <h3 class="txt-center">Templates</h3>
                  <div class="main mt-2">
                    <?php foreach ($templates as $data) { ?>
                      <div class="item">
                        <img src="/resumes/thumbnails/<?= $data['thumbnail'] ?>" class="img-cover" alt="Design">
                        <div class="options py-1 px-x">
                          <a href="#" class="bbtn secondary small use_template">
                            Use Template <i class="pl-1 fas fa-angle-double-right"></i>
                          </a>
                          <input type="hidden" value="<?= $data["template_id"] ?>" id="use_main">
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- CONTENT -->

              <div class="content page_section">
                <h3 class="">Content</h3>
                <div class="settings-component">
                  <div class="grid-items">
                    <div class="grid flex between">
                      <div class="item">Meta</div>
                      <div class="item">About</div>
                      <div class="item">Exports</div>
                      <div class="item">Version</div>
                    </div>
                  </div>
                  <div class="colors">
                    <div class="data-group" data-target="resume_info">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section class="create-preview">
            <div class="preview-container">
              <nav class="mobile-nav mobile-test flex between p-x">
                <button class="bbtn primary small close_mobile_preview"><i class="fas fa-arrow-left"></i></button>

                <p class="font-size-small">Preview..</p>
                <button class="btn_resume_dd nav_btn_dd"><i class="fas fa-download"></i></button>

                <div class="actions flex gap-1">
                  <button class="bbtn primary small flex gap-x btn_save_resume">
                    <i class="fas fa-save"></i>
                  </button>
                  <button class="bbtn secondary small pre flex gap-x btn_resume_dd">
                    <i class="fas fa-download"></i>
                  </button>
                </div>
              </nav>
              <article id="my_resume_wrapper" style="height: 508.298px;">
                <div id="my_resume_main" style="transform: scale(0.404444);">
                  <div id="resume_design" class="resume_previewer"></div>
                </div>
              </article>
            </div>
          </section>
        </main>
      </div>

      <!-- //welcome -->
      <?php if (!$user) : ?>
        <div id="page_loader" class="alert-unsigned">
          <div class="load_page layer_content flex column w-full gap-2">
            <p class="sync flex gap-1">
              <span class="loader inline-text"></span>
              <span>Syncing ...</span>
            </p>

            <div class="content p-1" style="max-width: 400px;">
              <h2 class="flex between txt-left">Hi There 👍 <button class="p-x font-size-1 btn_close_unsigned"><i class="fas fa-times"></i></button></h2>
              <p class="mt-2">Welcome to our Resume Generator, with high regard. Try creating an account to manages,
                create and save your resumes with hight user support</p>
            </div>

            <div class="flex between w-full" style="max-width: 400px;">
              <button class="bbtn primary clr-light btn_close_unsigned">Cancel</button>
              <a href="/app/?create=resume" class="bbtn secondary flex gap-2">Proceed <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- // Actiondd. preview  -->
      <div class="base-actions on_view">
        <!-- <button class="refresh_view"><i class="fas fa-undo"></i></button> -->
        <button class="btn_resume_dd btn_main_dd"><i class="fas fa-download"></i></button>
        <button class="btn_preview bbtn secondary flex gap-1">Preview <i class="fas fa-image"></i></button>
      </div>
      <!-- Toast Modul -->
      <?php include_once __DIR__ . "/../globals/toast-module.php" ?>
    </div>

    <script src="/static/scripts/jQuery.min.js"></script>
    <script src="/static/scripts/html2canvas.min.js"></script>
    <script src="/static/scripts/jspdf.umd.min.js"></script>
    <script type="module" src="/static/scripts/create.js"></script>
  </body>

  </html>