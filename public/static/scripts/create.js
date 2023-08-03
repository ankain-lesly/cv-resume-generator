/**
 * Main Resume Contrl
 * By: Ank Lee
 */

// Custom Objects
import { STORAGE_KEY } from "./config.js";
import { generateFormCard, RANGE_OBJECT } from "./form_objects.js";
import {
  useFetch,
  useStorage,
  useToast,
  setBtnAction as BA,
  handleAppTheme,
} from "./app_hooks.js";

// App Theme()
handleAppTheme();
const displayThemeBtns = () => {
  let theme = localStorage.getItem("app-theme") ?? "light";
  let icon = theme === "dark" ? "fa-sun" : "fa-moon";
  $("._theme_text").text(theme);
  $("._theme_icon").removeClass("fa-sun");
  $("._theme_icon").removeClass("fa-moon");
  $("._theme_icon").addClass(icon);
};
displayThemeBtns;
$(".theme-btn").on("click", () => displayThemeBtns());

$(document).ready(function (e) {
  let isLoading = false;
  // META DATA
  const META_DATA = {
    resume: $("#resume_main").val(),
    template: $("#template_main").val(),
  };
  // MY RESUME DATA
  let FORM_DATA = {};

  // Form section Objects
  const FORM_OBJECTS = {
    OBJECT_EDUCATION: {
      title: "Education",
      className: "education",
      form_object: "edu_object",
    },
    OBJECT_EXPERIENCE: {
      title: "Experience",
      className: "experience",
      form_object: "exp_object",
    },
    OBJECT_LANGUAGE: {
      title: "Language",
      className: "language",
      form_object: "lang_object",
    },
    OBJECT_SKILL: {
      title: "Skill",
      className: "skill",
      form_object: "skill_object",
    },
    OBJECT_HOBBY: {
      title: "Hobby",
      className: "hobby",
      form_object: "hobby_object",
    },
    OBJECT_SOCIAL: {
      title: "Social",
      className: "social",
      form_object: "social_object",
    },
  };

  // Form Actions Logic
  // Done
  $(document).on("click", ".btn_form_card_done", function (e) {
    $(this).closest(".form_card").removeClass("on_edit");
  });
  // Edit
  $(document).on("click", ".btn_form_card_edit", function (e) {
    $(".form_card").removeClass("on_edit");
    $(this).closest(".form_card").addClass("on_edit");
  });
  // Delete
  $(document).on("click", ".btn_form_card_delete", function (e) {
    let key = $(this).closest(".form_card").find(".unique_key").val();

    if (key) {
      const section = $(this).closest(".area-step").data("section-title");
      const formObject = FORM_DATA[section];
      const newObject = {};

      $.each(formObject, (a, b) => {
        if (key != a) newObject[a] = b;
      });
      FORM_DATA[section] = newObject;
      useStorage(STORAGE_KEY, FORM_DATA);
      updatePreviewer(FORM_DATA);
      $(this).closest(".form_card").remove();
    }
  });

  // Add FORM GROUP
  $(document).on("click", ".btn_form_card_add", function (e) {
    $(".form_card").removeClass("on_edit");
    const $btn = $(this);
    const target = $btn.data("target");
    const object = $btn.data("form-object");

    $(target).append(generateFormCard("", {}, FORM_OBJECTS[object], "on_edit"));
  });

  // Education
  // $(this)
  //   .closest(".form_card")
  //   .find(".group_caption")
  //   .text(e.target.value.trim());
  $(document).on(
    "keyup, change",
    "#education, #position, .social_input",
    function (e) {
      console.log("Logging..");
      changeCaptionOnEdit($(this), "group_caption");
    }
  );
  // Hobbie Inputs name
  $(document).on("keyup", ".hobby_input", function (e) {
    changeCaptionOnEdit($(this), "hobby_heading");
  });
  // ON Range Input Text
  $(document).on("change", ".range_title_input", function (e) {
    changeCaptionOnEdit($(this), "range_title");
  });
  $(document).on("keyup", ".range_title_input", function (e) {
    changeCaptionOnEdit($(this), "range_title");
  });
  const changeCaptionOnEdit = ($el, $target) =>
    $el.closest(".form_card").find(`.${$target}`).text($el.val().trim());

  // Range Input range
  $(document).on("input", ".range_input", function (e) {
    const $target = $(this);
    const val = $target.val();
    const label = RANGE_OBJECT[val] ?? "Make a choise";

    const size = val + "% 100%";
    $target.css("background-size", size);

    const $parent = $target.closest(".form_card");

    $parent.find(".bubble").text(val);
    $parent.find(".pro_caption").text(label);
    $parent.find(".range_proficiency").text(label);
  });
  // Load Default form
  const LoadDefaultForm = () => {
    // Clearing...
    $(".education-main").html("");
    $(".experience-main").html("");
    $(".language-main").html("");
    $(".skill-main").html("");
    $(".hobby-main").html("");
    $(".social-main").html("");

    // Loading Default structure
    $(".education-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_EDUCATION"], "on_edit")
    );
    $(".experience-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_EXPERIENCE"], "on_edit")
    );
    $(".language-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_LANGUAGE"], "on_edit")
    );
    $(".skill-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_SKILL"], "on_edit")
    );
    $(".hobby-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_HOBBY"], "on_edit")
    );
    $(".social-main").append(
      generateFormCard("", [], FORM_OBJECTS["OBJECT_SOCIAL"], "on_edit")
    );
  };

  // Load form with Data
  const LoadFormData = (formObject) => {
    LoadDefaultForm();
    $.each(formObject, (section_key, data) => {
      // console.log(section_key)
      if (section_key === "personal") {
        $.each(data, (key, value) => {
          // data-inp-reff="picture"
          $(`[data-inp-reff="${key}"]`).val(value);
        });
      } else if (section_key === "cover_photo") {
        $(".img-cover-profile").attr("src", "/uploads/covers/" + data);
      } else if (data) {
        const formObjectReff =
          FORM_OBJECTS[`OBJECT_${section_key.toUpperCase()}`];

        if (!formObjectReff) return;

        $(`.${section_key}-main`).html("");
        $.each(data, (key, object) => {
          $(`.${section_key}-main`).append(
            generateFormCard(key, object, formObjectReff)
          );
        });
      }
    });
  };

  /* *** METHOD ONE *** */
  // saving form-data
  $(document).on("blur", "[data-inp-reff]", function (e) {
    console.log("Typing ...");

    const section = $(this).closest(".area-step").data("section-title");
    const formObject =
      FORM_DATA[section] == null || FORM_DATA[section] == ""
        ? {}
        : FORM_DATA[section];

    if (section === "personal") {
      formObject[$(this).data("inp-reff")] = $(this).val();
    } else {
      const section_key = $(this)
        .closest(".form_card")
        .find(".unique_key")
        .val();
      if (section === "hobby") {
        formObject[section_key] = $(this).val();
      } else {
        const section_data = formObject[section_key] ?? {};

        // console.log(e.target.checked);

        section_data[$(this).data("inp-reff")] = e.target.checked
          ? "true"
          : $(this).val()
          ? $(this).val()
          : "";

        // console.log(section_data);
        formObject[section_key] = section_data;
      }
    }
    FORM_DATA[section] = formObject;
    useStorage(STORAGE_KEY, FORM_DATA);
    updatePreviewer(FORM_DATA);
  });

  $(".refresh_view").on("click", () => updatePreviewer(FORM_DATA));
  //- updatePreviewer()
  function updatePreviewer(data = {}) {
    // data["meta"] = META_DATA;
    $(".resume_previewer").load(
      "/resume/render/" + META_DATA.template,
      data,
      () => {
        resizePreviewer();

        if (!$("#page_loader").hasClass("loaded"))
          $("#page_loader").addClass("loaded");
      }
    );
  }
  $("#page_loader").addClass("loaded");

  // On window resize
  window.addEventListener("resize", resizePreviewer);

  //Responsive Scaling
  function resizePreviewer() {
    let wrapperWidth = $("#my_resume_wrapper").width();
    let contentWidth = $("#my_resume_main").width();

    if (contentWidth >= wrapperWidth) {
      let scale = wrapperWidth / contentWidth;

      // content.style.transform = `scale(${scale})`;
      $("#my_resume_main").css("transform", `scale(${scale})`);

      let height = $("#my_resume_main").height();

      $("#my_resume_wrapper").css("height", height * scale);

      console.log("Scalling view...");
    }
  }

  // GETTING SAVED DATA
  async function loadSavedData() {
    let formData;
    // if -> get from storage
    formData = useStorage(STORAGE_KEY);

    if (!formData) {
      // if -> get from database
      const res = await useFetch("GET", "/resume/" + META_DATA.resume + "/");
      if (!res) {
        useToast("Connections error: Loading default form interface 🐱‍🏍");
        return LoadDefaultForm();
      }

      if (res.data) {
        formData = res.data;
      } else if (!res.response.ok || res.response.status !== 200) {
        alert("Error getting data please try again..");
      } else {
        return LoadDefaultForm();
      }
    }

    $.each(formData, (a, b) => (formData[a] = !b || b === "" ? {} : b));
    // console.log(formData);
    FORM_DATA = formData;
    LoadFormData(formData);
    updatePreviewer(formData);
  }
  loadSavedData();
  // Clear Resume Form
  $(".btn_clear").on("click", () => {
    BA.name(".btn_clear");
    BA.loading();

    $.each($(".personal [data-inp-reff]"), (index, input) => {
      input.value = "";
    });
    $(".img-cover-profile").attr("src", "/static/media/user.png");
    FORM_DATA = {};
    useStorage(STORAGE_KEY, FORM_DATA);
    updatePreviewer(FORM_DATA);
    LoadDefaultForm();
    BA.done();
  });
  // Save Resume
  $(".btn_save_resume").on("click", () => {
    if (isLoading) return;
    isLoading = true;
    BA.name(".btn_save_resume");
    BA.loading();

    setTimeout(() => {
      saveResume(FORM_DATA);

      BA.done();
      isLoading = false;
    }, 500);
  });

  $(".btn_resume_dd").on("click", function (e) {
    // window.jsPDF = window.jsPDF;
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF();
    // Source HTMLElement or a string containing HTML.
    var elementHTML = document.querySelector("#resume_design");
    doc.html(elementHTML, {
      callback: function (doc) {
        // Save the PDF
        doc.save("Resume-html.pdf");
      },
      margin: [10, 10, 10, 10],
      autoPaging: "text",
      x: 0,
      y: 0,
      width: 125, //target width in the PDF document
      windowWidth: 675, //window width in CSS pixels
      // width: 190, //target width in the PDF document
      // windowWidth: 1025, //window width in CSS pixels
    });
  });
  /*
  // Download Resume
  $(".btn_resume_dd").on("click", function (e) {
    BA.name(".btn_resume_dd");
    BA.loading();
    window.jsPDF = window.jsPDF;
    const { jsPDF } = window.jspdf;
    // var doc = new jsPDF("p", "in", [8.26, 11.69]);
    // var doc = new jsPDF("p", "mm", [524, 1024]);
    // var doc = new jsPDF("p", "mm", [210, 297]);
    var doc = new jsPDF();
    // let date = new Date();
    // let timeSpanFileName = "Resume-" + date.toLocaleString() + ".pdf";
    let timeSpanFileName = "Resume-123.pdf";
    console.log(timeSpanFileName);
    // const resume = document.querySelector("#resume_design");
    // const resume = document.querySelector("#my_resume_main");
    const resume = document.querySelector("#resume_design");

    doc.html(resume, {
      callback: function (doc) {
        doc.save(timeSpanFileName);
        BA.done();
      },
      x: 20,
      y: 20,
    });
  });
*/
  // CHANGE COVER PHOTO
  $("#resume_photo").on("change", function (e) {
    BA.name(".btn_save_resume");
    BA.loading();
    const file = $(this).prop("files")[0];

    if (!file) return;

    let source = window.URL.createObjectURL(file);
    const formObj = new FormData();
    formObj.append("image", file);
    formObj.append("cover_photo", "cover photo");
    formObj.append("resume_id", META_DATA.resume);
    formObj.append("current", FORM_DATA["cover_photo"] ?? false);

    $.ajax({
      url: "/resume/update/" + META_DATA.resume,
      method: "post",
      contentType: false,
      processData: false,
      cache: false,
      data: formObj,
      success: function (res) {
        const data = JSON.parse(res) ?? false;
        if (data && data.success) {
          FORM_DATA["cover_photo"] = data.cover;
          updatePreviewer(FORM_DATA);
          useStorage(STORAGE_KEY, FORM_DATA);
          BA.name(".btn_save_resume");
          BA.loading();

          $(".img-cover-profile").attr("src", source);

          setTimeout(() => {
            BA.done();
          }, 500);
        }
      },
    });
  });
  // Download Resume
  // $(".change_template").on("click", function (e) {});

  // Save Resume
  const saveResume = async (data) => {
    if (META_DATA.resume == "XR-12345678-Lee")
      return useToast(
        "Ooop, You cannot save an untitled resume. Login to dashboard and create one. 🐱‍🏍"
      );
    const formData = data;
    formData.meta = META_DATA;

    const res = await useFetch(
      "POST",
      "/resume/update/" + META_DATA.resume,
      formData
    );

    if ($res && res.data && res.data.success) {
      useToast("Resume saved.. 😊");
    } else {
      useToast("Failed to save data.. 🚩");
    }
  };

  $(".use_template").on("click", async function (e) {
    let template_id = $(this).siblings("#use_main").val();
    // console.log(template);

    const res = await useFetch("POST", "/resume/meta", {
      resume_id: META_DATA.resume,
      template_id: template_id,
      update_meta: "true",
    });

    if (res && res.data && res.data.success) {
      useToast("Template changed.. 😊");
      META_DATA.template = res.data.template;
      updatePreviewer(FORM_DATA);
    }
  });

  /**
   * Main Page Panel
   *
   */
  // Panel Pages
  $(".btn_close_unsigned").on("click", function (e) {
    $(".alert-unsigned").fadeOut();
  });
  setTimeout(() => $(".alert-unsigned").addClass("show"), 10000);
  // panels
  $(".panel_btn").on("click", function (e) {
    $(".panel_btn").removeClass("active");
    $(this).addClass("active");
    const section = $(this).data("target");
    $(".page_section").removeClass("on_page");
    $(`.${section}`).addClass("on_page");
    $(".area-step").removeClass("active");
  });
  // FORM SECTIONS
  $(".control_action").on("click", function (e) {
    $(".area-step").removeClass("active");
    const section = $(this).data("form-section");
    $(`.${section}`).addClass("active");
    $(`[data-section-title="${section}"]`).addClass("active");
  });
  // PAGES Sections
  $(".btn_page_section").on("click", function (e) {
    $(".area-step").removeClass("active");
  });

  $(".btn_panel").on("click", function (e) {
    let $panel = $(".side_panel");

    if ($panel.hasClass("active")) {
      $panel.removeClass("active");
    } else {
      $panel.addClass("active");
    }
  });
  // Preview Options
  $(".btn_preview").on("click", function (e) {
    $(".create-preview").fadeIn();
    updatePreviewer(FORM_DATA);
  });
  $(".close_mobile_preview").on("click", function (e) {
    $(".create-preview").fadeOut();
  });
});
