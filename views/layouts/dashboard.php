<?php include_once __DIR__ . "/../globals/dash-headTags.php"; ?>
</head>

<body>
  <div id="root">
    <div class="dashboard-main">
      <div class="container">
        <?php include_once __DIR__ . "/../globals/dash-sideNav.php"; ?>
        <section class="main-content">
          <?php include_once __DIR__ . "/../globals/dash-header.php"; ?>

          <!-- Page View Start -->
          {{content}}
          <!-- Page View Ends -->

        </section>
      </div>
    </div>
    <div class="popup-main">
      <div class="nav container-x flex start">
        <button class="close-main nav-btn btn btn-s"><i class="fas fa-arrow-left"></i> Cancel</button>
      </div>
      <div class="container flex">
        <div class="content resume-info">
          <div id="resume_meta">
            <div class="create-step details animate-box-in active">
              <div class="flex animate-box-in column gap-2">
                <div class="head w-full">
                  <div class="step-show">Step One</div>
                  <h2>Create a resume</h2>
                </div>
                <div class="form-group w-full">
                  <label for="meta_title">Resume title</label>
                  <input type="text" id="meta_title" placeholder="Enter resume title.." required>
                </div>
                <div class="form-group w-full">
                  <label for="meta_description">Description</label>
                  <textarea id="meta_description" cols="30" rows="5" required
                    placeholder="Enter description.."></textarea>
                </div>
                <div class="actions flex between w-full">
                  <span class="close-main btn">Cancel</span>
                  <span data-step="templates" class="btn-p btn">Next Step</span>
                </div>
              </div>
            </div>
            <div class="create-step templates animate-box-in">
              <div class="head">
                <div class="step-show flex between">
                  <span data-step="details" class="btn">
                    <i class="fas fa-arrow-left  mr-2"></i>
                    <span class="step-show">Step Two</span>
                  </span>
                </div>
                <h3>Select A Template</h3>
              </div>
              <div class="templates-main-cover">
                <div class="templates-main">
                  <div class="wait flex w-full">
                    <div class="loader"></div>
                  </div>
                </div>
              </div>
              <div class="actions">
                <div class="flex end pb-2">
                  <button class="flex create_meta form_btn">
                    <span class="mr-1 p-main"> Create Now </span>
                    <i class="fas fa-arrow-right p-main"></i>
                    <span class="p-odd mr-1">Processing...</span>
                    <span class="p-odd loader inline-text mr-1"></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- TEMPLATE PREVIEWER -->
        <div class="template_previewer">
          <div class="container-x">
            <div class="nav flex between">
              <button class="btn_select btn btn-p">
                Select <i class="fas fa-check"></i>
              </button>
              <button class="close_previewer">
                <small>close </small>
                <span class="fas fa-times"></span>
              </button>
            </div>
            <div class="preview">
              <button class="arrow show_temp_left">
                <span class="fas fa-angle-left"></span>
              </button>
              <div class="image">
                <img src="#" id="preview_image" alt="Template">
              </div>
              <button class="arrow show_temp_right">
                <span class="fas fa-angle-right"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once __DIR__ . "/../globals/dash-footer.php"; ?>
  </div>

  <script src="/static/scripts/jQuery.min.js"></script>
  <script type="module" src="/static/scripts/main.js"></script>
</body>

</html>