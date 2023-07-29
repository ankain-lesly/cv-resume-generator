  <!-- GLOBALS -->
  <?php include_once __DIR__ . "/../globals/globals.php" ?>

  <title>Untitled | Resume</title>
  <link rel="stylesheet" href="/static/styles/create_new.css" />
  <style type="text/css">
#my_resume_wrapper {
  margin: auto;
  overflow: hidden;
  margin: auto;
  width: 100%;
  max-width: 550px;
  border: 2px solid #333333ae;
  border-radius: 0.5em;
  box-shadow: 1px 2px 20px #333;
  cursor: zoom-in;
}

#my_resume_main {
  width: 1000px;
  transform-origin: 0 0;
}

/*// Loader*/
#page_loader {
  position: fixed;
  width: 100vw;
  z-index: 1500;
  top: 0;
}

#page_loader.loaded {
  display: none !important;
}

#page_loader .load_page {
  height: 100vh;
  /*pointer-events: none;*/
}

#page_loader .layer_content {
  cursor: wait;
  background-color: rgba(0, 0, 0, 0.6);
}

#page_loader .sync {
  padding: 0.5em 1em;
}

#page_loader .sync,
#page_loader .content {
  border-radius: 0.35em;
  background-color: var(--clr-white);
  color: var(--clr-bg);
  font-size: 0.8rem;
  box-shadow: 6px 10px 28px 0px rgba(0, 0, 0, 0.4);
  text-align: center;

}

#page_loader .content {
  margin-top: 2rem;
  padding: 1em;
  width: 100%;
  max-width: 400px;
}
  </style>
  </head>

  <body>
    <div class="root">
      <div class="create-resume">
        <header class="main-header flex between gap-1">
          <a href="/dashboard/"><span class="clr-danger">Res</span>ume</a>

          <div class="title flex-1 txt-center" style="overflow: hidden">
            <p class="txt-ellipsis">Untitled Resume</p>
          </div>

          <div class="actions flex gap-1">
            <button class="bbtn primary flex gap-x btn_save_resume">
              <i class="fas fa-trash"></i> Clear
            </button>
            <button class="bbtn primary flex gap-x btn_save_resume">
              <i class="fas fa-save"></i> Save
            </button>
            <button class="bbtn primary flex gap-x">
              CV <i class="pl-1 fas fa-caret-down"></i>
            </button>
            <button class="bbtn secondary pre flex gap-x">
              <i class="fas fa-download pr-x"></i> Download
            </button>
          </div>
        </header>
        <div id="page_loader">
          <div class="load_page layer_content flex column">
            <p class="sync flex gap-1">
              <span class="loader inline-text"></span>
              <span>Syncing ...</span>
            </p>

            <div class="content">
              <h2>Ooops</h2>
              <p class="mt-2">The resume you are trying to access is not available. Create one to proceed</p>
              <br>
              <a href="<?= $user ? "/dashboard/?create=resume" : "/#templates" ?>" class="bbtn small secondary">Continue
                <i class="fas fa-angle-double-right"></i></a>
            </div>
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
                <li data-target="create_forms" class="panel_action active">
                  <i class="fas fa-pencil-alt icon"></i>
                  <p class="text">Create</p>
                </li>
                <li data-target="templates" class="panel_action">
                  <i class="fas fa-edit icon"></i>
                  <p class="text">Templates</p>
                </li>
                <li data-target="settings" class="panel_action">
                  <i class="fas fa-greater-than icon"></i>
                  <p class="text">Settings</p>
                </li>
                <li data-target="content" class="panel_action">
                  <i class="fas fa-radiation icon"></i>
                  <p class="text">Content</p>
                </li>
                <li class="panel_action btn_save_resume">
                  <i class="fas fa-save icon"></i>
                  <p class="text">Save</p>
                </li>
                <li class="theme_btn flex gap-x">
                  <i class="fas fa-moon icon"></i>
                  <span class="text"> Dark</span>
                </li>
              </ul>
            </div>
            <div class="main_content pages">
              <div class="head">
                <button class="btn_close_panel btn_panel" title="close side panel">
                  <i class="fas fa-angle-double-right"></i>
                </button>
              </div>
              <!-- // CREATE -->
              <div class="create_forms page_section on_page">
                <div class="intro mb-1">
                  <h3>Create resume</h3>
                  <small>Select a section form below to</small>
                  <div class="resume_info" style="display: none">
                    <input type="hidden" id="resume_id" value="<?= $resume['resume_id'] ?>" />
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
                <div class="form-content personal">
                  <!-- // Personal Details -->
                  <div class="personal-1 flex gap-2 top">
                    <div class="form-goup">
                      <input type="text" id="picture" style="display: none" data-inp-reff="picture" />
                      <input type="file" id="resume_photo" data-placeholder=".photo_placeholder" accept="images/*" />
                      <label for="resume_photo" class="picture_holder">
                        <div class="picture">
                          <img src="/static/media/user.png" class="img-cover" alt="Profile Picture" />
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
                    <span data-target=".education-main" data-form-object="OBJECT_EDUCATION"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
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
                    <span data-target=".experience-main" data-form-object="OBJECT_EXPERIENCE"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
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
                    <span data-target=".social-main" data-form-object="OBJECT_SOCIAL"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
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
                    <span data-target=".language-main" data-form-object="OBJECT_LANGUAGE"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
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
                    <span data-target=".skill-main" data-form-object="OBJECT_SKILL"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
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
                    <span data-target=".hobby-main" data-form-object="OBJECT_HOBBY"
                      class="bbtn primary small w-fit flex gap-x btn_form_card_add">
                      <i class="fas fa-plus"></i>
                      <small class="text">Add hobby</small>
                    </span>
                    <input type="hidden" id="ed_key" />
                  </div>
                </div>
              </div>

              <div class="page_options_btn">
                <div class="container flex end gap-2">
                  <button class="btn_page_section bbtn secondary small">
                    <i class="fas fa-times pr-x"></i> Close
                  </button>
                </div>
              </div>
              <!-- // SETTINGS  -->
              <div class="settings page_section">SETTINGS</div>
              <!-- // TEMPLATES -->
              <div class="templates page_section">TEMPLATES</div>
              <div class="content page_section">CONTENT</div>
            </div>
          </section>
        </main>
      </div>
      <!-- Toast Modul -->
      <?php include_once __DIR__ . "/../globals/toast-module.php" ?>
    </div>

    <script src="/static/scripts/jQuery.min.js"></script>
  </body>

  </html>