<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Untitled | Resume</title>
  <link rel="stylesheet" href="/static/styles/create.css" />
  <link rel="stylesheet" href="/00FA/css/all.css" />
  <style type="text/css">
    #my_resume_wrapper {
      margin: auto;
      overflow: hidden;
      margin: auto;
      width:100%;
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
      display: grid;
      grid-template-columns: repeat(2, 50%);
      z-index: 1500;
      top:0;
    }
    #page_loader.loaded {
      display: none!important;
    }
    #page_loader .load_page{
      height: 100vh;
      /*pointer-events: none;*/
    }
    #page_loader .layer_content {
      cursor: wait;
      background-color: rgba(0,0,0,0.4);
    }
    #page_loader .sync {
      padding: 0.5em 1em;
      border-radius: 0.35em;
      background-color: var(--clr-white);
      color: var(--clr-bg);
      font-size: : 0.8rem;
      box-shadow:6px 10px 28px 0px rgba(0,0,0,0.4);
    }
    #page_loader .layer_preview {
      box-shadow:6px 10px 28px 0px rgba(0,0,0,0.4);
      background-color: var(--clr-white);
      /*color: var(--clr-bg);*/
      cursor: alias; 
    }
  </style>
</head>

<body>
  <div class="create-resume">
    <header class="main-header flex between gap-1">
      <a href="/dashboard/" class="bbtn primary">
        <i class="fas fa-arrow-left pr-1"></i> Resume
      </a>

      <div class="title flex-1 txt-center" style="overflow: hidden">
        <p class="txt-ellipsis">Untitled resume</p>
      </div>

      <div class="actions flex gap-1">
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
      <div class="load_page layer_content flex">
        <p class="sync flex gap-1">
          <span class="loader inline-text"></span>
          <span>Syncing ...</span>
        </p>
      </div>
      <div class="load_page layer_preview flex">
        <p>Please wait ...</p>
      </div>
    </div>

    <div class="container-main">
      <!-- create Forms -->
      <section class="create-form">
        <h3 class="section-title">Resume Details</h3>
        <div class="form-area">
          <div class="resume_info" style="display: none">
            <input type="hidden" id="resume_id" value="<?= $resume['resume_id'] ?>">
          </div>
          <!-- item step PERSONAL -->
          <div data-section-title="personal" class="area-step active">
            <div class="head flex between">
              <p>Personal Infomation</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
            </div>
            <div class="form-content personal">
              <!-- // Personal Details -->
              <!-- Photo and details -->
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
          </div>
          <!-- item step EDUCATION -->
          <div data-section-title="education" class="area-step">
            <div class="head flex between">
              <p>Education</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
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
            <div class="head flex between">
              <p>Work Experience</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
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
          <!-- item step LANGUAGE -->
          <div data-section-title="language" class="area-step">
            <div class="head flex between">
              <p>Languages</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
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
            <div class="head flex between">
              <p>Skills</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
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
            <div class="head flex between">
              <p>Hobbies</p>
              <button class="bbtn primary small area-botton">
                <i class="fas fa-caret-down drop-icon"></i>
              </button>
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
        </div>

        <br />
        <br />
        <br />
        <div class="actions flex gap-2 end">
          <button class="bbtn secondary w-fit mr-2 btn_save_resume">
            SAVE RESUME
            <i class="pl-1 fas fa-angle-double-right"></i>
          </button>
        </div>
      </section>
      <section class="create-preview">
        <div class="preview-container">
          <nav class="mobile-nav mobile-test">Nav Items</nav>
          <article id="my_resume_wrapper">
            <div id="my_resume_main" class="resume_previewer">
              // RESUME 
            </div>
          </article>
        </div>
      </section>
    </div>
  </div>

  <script src="/static/scripts/jQuery.min.js"></script>
  <script type="module" src="/static/scripts/create.js"></script>

<!-- <script>
    let wrapper = document.getElementById("my_resume_wrapper"),
        content = document.getElementById("my_resume_main"),
        wrapperWidth, contentWidth, scale;
    //Responsive Scaling

    window.addEventListener("resize", resize);
    resize();

    function resize() {
      wrapperWidth = wrapper.clientWidth;
      contentWidth = content.clientWidth;

      if (contentWidth >= wrapperWidth) {
        scale = wrapperWidth / contentWidth;
        content.style.transform = `scale(${scale})`;

        const height = $('#my_resume_main').height();

        $('#my_resume_wrapper').css("height", height * scale)

        console.log('Scalling view...');
      }
    }
  </script> -->
</body>

</html>