<?php
$data = $edit_data ?? null;

include_once __DIR__ . "/../globals/globals.php";
?>


<title>Upload Resume Templates</title>
<link rel="stylesheet" href="/static/styles/template-create.css">
</head>

<body>
  <div class="flower  section-p">
    <div class="avatar txt-center">
      <i class="fas fa-radiation"></i>
    </div>
    <h2 class="pt-2 pb-2mt-2 mb-2 txt-center">Create a Template</h2>
    <div class="links txt-center flex wrap">
      <a class="btn font-size-small clr-warning" href="/app/"><i class="fas fa-arrow-left"></i> Dashboard</a>
      <a class="btn font-size-small clr-warning" href="/templates/resume">Templates <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    <main class="container-x main">
      <div class="layer previewer">
        <h3>Preview</h3>
        <div class="content flex <?= $data ? 'data' : '' ?>">
          <img src="<?= $data ? "/resumes/thumbnails/" . $edit_data['thumbnail'] : '#' ?>" alt="Template">
          <div class="text">PREVIEWER</div>
        </div>
      </div>
      <div class="layer form">
        <h3>Create</h3>
        <div class="content">
          <form method="post" enctype="multipart/form-data">
            <!-- // Title -->
            <input type="text" name="title" placeholder="Enter title" value="<?= $data ? $data['title'] : '' ?>"
              required>
            <!-- Image -->
            <div class="form-group">
              <label for="file_image" class="flex">[ Image Thumbnail ]
                <?= $data ? "<i class='fas fa-dot-circle clr-danger pl-2'></i>" : '' ?>
              </label>
              <input type="file" id="file_image" placeholder="Template thumbnail" name="file_image" accept=".png"
                required>
            </div>
            <!-- // Files -->
            <div class="group flex gap-2">
              <div class="form-group">
                <label for="file_php" class="flex">[ PHP File ]
                  <?= $data ? "<i class='fas fa-dot-circle clr-danger pl-2'></i>" : '' ?></label>
                <input type="file" id="file_php" placeholder="Template thumbnail" name="file_php" accept=".php"
                  required>
              </div>
              <div class="form-group">
                <label for="file_css" class="flex">[ CSS File ]
                  <?= $data ? "<i class='fas fa-dot-circle clr-danger pl-2'></i>" : '' ?></label>
                <input type="file" id="file_css" placeholder="Template thumbnail" name="file_css" accept=".css"
                  required>
              </div>
            </div>
            <div class="setup_area input">
              <div class="x-layout-setup flex wrap start gap-x mb-1">
                <p class="setting">
                  <span class="text">new</span>
                  <span class="icon ml-x"><i class="fas fa-times"></i></span>
                </p>
              </div>
              <!-- custom select -->
              <div class="custom_select">
                <div class="select_btn flex between input" style="margin: 0;">
                  <span class="label">
                    Add settings
                  </span>
                  <input type="hidden" id="selected_info" name="settings"
                    value="<?= $data ? $data['settings'] : '' ?>" />
                  <i class="fas fa-caret-down"></i>
                </div>

                <div class="data_container">
                  <div class="custome_select_overlay"></div>
                  <div class="select_content">
                    <div class="select_search">
                      <input type="search" class="search_input" placeholder="Search..." />
                      <i class="search_icon fas fa-search"></i>
                      <span class="fas fa-times search-close"></span>
                    </div>
                    <ul class="options">
                      <li class="list-option flex between false">
                        <span class="option_text" data-option-value="123">name</span>
                        <i class="option_icon fas fa-caret-left"></i>
                      </li>
                      <p class="option_text mt-1 mb-1 txt-center clr-warning">No Doctors Found. Contact Admin</p>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <button class="bbtn secondary"><i class="fas fa-angle-double-right"></i></button>
            <p class="w-full txt-center font-size-small">Form Sections Await</p>
          </form>
        </div>
      </div>
    </main>

    <div class="footer txt-center">
      <h5>Read more</h5> <a href="/about?templates" class="clr-warning">About creating a template</a>
    </div>
    <?php include_once __DIR__ . "/../globals/toast-module.php" ?>
  </div>
  <script src="/static/scripts/jQuery.min.js"></script>
  <script>
  /**
   * CUSTOM SELECT OPTIONS
   */

  let settingsObj;
  let selectedSetting = [];

  // clsoe select panel
  $(document).on("click", ".custome_select_overlay", function(e) {
    $(this).closest(".custom_select").removeClass("active");
  });

  $(document).on("click", ".select_btn", function(e) {
    // const $customSelect = $(this).closest(".custom_select");
    $(this).closest(".custom_select").addClass("active");
  });

  // type to search
  $(document).on("keyup", ".custom_select .search_input", (e) => {
    let keyword = e.target.value.trim().toLowerCase();
    let newData = settingsObj.sort((first, second) => {
      console.log(keyword, first, second);
      if (first.toLowerCase().indexOf(keyword) > -1) return -1;
      if (second.toLowerCase().indexOf(keyword) > -1) return 1;
      else return 0;
    });

    loadOptions(newData, true);
  });
  // Disable custom select
  $(document).on("click", ".custom_select .search-close", function(e) {
    $(".custom_select").removeClass("active");
  });
  // click to select an option
  $(document).on("click", ".custom_select .list-option", function(e) {
    if ($(this).hasClass("selected")) return;

    const text = $(this).find(".option_text").text() ?? null;

    $(this).addClass("selected");
    selectedSetting.push({
      name: text
    });
    renderSeleted(selectedSetting);
  });
  $(document).on("click", ".btn_setting", function(e) {
    let key = $(this).siblings(".text").text();
    $("[data-option-value='" + key + "']")
      .closest("li")
      .removeClass("selected");
    selectedSetting = selectedSetting.filter((a) => a.name !== key);
    renderSeleted(selectedSetting);
    // selectedSetting[key] = text;
    // renderSeleted(selectedSetting);
  });

  function renderSeleted(object) {
    let inputValue = "";

    $(".x-layout-setup").html("");
    $.each(object, (key, option) => {
      $(".x-layout-setup").append(`<p class="setting">
        <span class="text" data-key="${option.name}">${option.name}</span>
        <span class="icon ml-x btn_setting"><i class="fas fa-times"></i></span>
      </p>`);

      inputValue += option.name + ",";
    });

    $("#selected_info").val(inputValue);
  }

  function loadOptions(option, isSearch = false) {
    let settings = isSearch ? $("#selected_info").val() : false;

    $(".custom_select .options").html("");
    $.each(option, (key, value) => {
      $(".custom_select .options").append(`
      <li class="list-option flex between ${
        settings && settings.includes(value + ",") ? "selected" : ""
      }">
      <span class="option_text" data-option-value="${value}">${value}</span>
      <i class="option_icon fas fa-caret-left"></i>
      </li>`);
    });
  }

  function runOnEdit() {

    let settings = $("#selected_info").val();
    if (!settings) return;

    selectedSetting = settings.split(',').filter(val => val != "").map((value) => ({
      name: value,
    }))

    renderSeleted(selectedSetting);
  }

  // Update Selection on edit
  runOnEdit()
  settingsObj = [
    "picture",
    "firstname",
    "lastname",
    "address",
    "date_of_birth",
    "headline",
    "about",
    "email",
    "phone",
    "education",
    "school",
    "present",
    "description",
    "position",
    "employer",
    "start_date",
    "end_date",
    "city",
    "social",
    "handle",
    "skill",
    "language",
    "proficiency",
    "hobby",
  ];
  loadOptions(settingsObj);

  $("#file_image").change(function(e) {
    const file = $(this).prop("files")[0];
    if (file) {
      let source = window.URL.createObjectURL(file);
      $(".previewer .content").find("img").attr("src", source);
      $(".previewer .content").addClass("data");
    }
  });
  </script>
</body>

</html>