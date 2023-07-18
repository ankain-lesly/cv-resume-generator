// Custom Objects
import { generateFormCard } from "./form_objects.js";
import { useFetch, useToken, useStorage } from "./custom_hooks.js";

$(document).ready(function (e) {
  // RESUME KEY
  let TEMPLATE_MAIN = $("#resume_id").val();

  // MY RESUME DATA
  let FORM_DATA = {};
  const STORAGE_KEY = "my_resume";

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
  };

  // Form Sections Accord
  $(".area-step .form-content").slideDown();
  // $(".area-step.active .form-content").addClass("c-shown").slideDown();
  // $(".area-step .head").on("click", function (e) {
  //   $(".area-step").removeClass("active");
  //   $(".form-content").slideUp();

  //   $(this).closest(".area-step").addClass("active");
  //   let $content = $(this).siblings(".form-content");

  //   if (!$content.hasClass("c-shown")) {
  //     $content.addClass("c-shown").slideDown();
  //   } else {
  //     $content.removeClass("c-shown").slideUp();
  //   }
  // });

  // Form Action Logic
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
    $(this).closest(".form_card").remove();
  });

  // Add FORM GROUP
  $(document).on("click", ".btn_form_card_add", function (e) {
    $(".form_card").removeClass("on_edit");
    const $btn = $(this);
    const target = $btn.data("target");
    const object = $btn.data("form-object");

    $(target).append(generateFormCard({}, FORM_OBJECTS[object], "on_edit"));
  });

  // Range
  const RANGE_OBJECT = {
    0: "Make a choice",
    20: "Beginner",
    40: "Moderate",
    60: "Good",
    80: "Very good",
    100: "Excellent",
  };

  // Education
  $(document).on("keyup", "#education, #position", function (e) {
    $(this)
      .closest(".form_card")
      .find(".group_caption")
      .text(e.target.value.trim());
  });
  // Hobbie Inputs name
  $(document).on("keyup", ".hobby_input", function (e) {
    $(this)
      .closest(".form_card")
      .find(".hobby_heading")
      .text(e.target.value.trim());
  });
  // ON Range Input Text
  $(document).on("keyup", ".range_title_input", function (e) {
    $(this)
      .closest(".form_card")
      .find(".range_title")
      .text(e.target.value.trim());
  });
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
    $(".education-main").append(
      generateFormCard("", FORM_OBJECTS["OBJECT_EDUCATION"])
    );
    $(".experience-main").append(
      generateFormCard("", FORM_OBJECTS["OBJECT_EXPERIENCE"])
    );
    $(".language-main").append(
      generateFormCard("", FORM_OBJECTS["OBJECT_LANGUAGE"])
    );
    $(".skill-main").append(generateFormCard("", FORM_OBJECTS["OBJECT_SKILl"]));
    $(".hobby-main").append(generateFormCard("", FORM_OBJECTS["OBJECT_HOBBY"]));
  };

  // Load form with Data
  const LoadFormData = (formObject) => {
    $.each(formObject, (section_key, data) => {
      // console.log(section_key)
      if (section_key === "personal") {
        $.each(data, (key, value) => {
          // data-inp-reff="picture"
          $(`[data-inp-reff="${key}"]`).val(value);
        });
      } else {
        const formObjectReff =
          FORM_OBJECTS[`OBJECT_${section_key.toUpperCase()}`];
        $.each(data, (key, object) => {
          formObjectReff["unique_key"] = key;
          // console.log(formObjectReff)
          $(`.${section_key}-main`).append(
            generateFormCard(object, formObjectReff)
          );
        });
      }
    });
  };

  /* *** METHOD ONE *** */
  // saving form-data
  $(document).on("blur", "[data-inp-reff]", function (e) {
    console.log("Typing stopped...");
    const section = $(this).closest(".area-step").data("section-title");
    const formObject = FORM_DATA[section] ?? {};

    if (section === "hobby") {
      const hobbyData = FORM_DATA[section] ?? [];

      hobbyData.push($(this).val());
      FORM_DATA[section] = hobbyData;
    } else if (section === "personal") {
      formObject[$(this).data("inp-reff")] = $(this).val();
      FORM_DATA[section] = formObject;
    } else {
      const section_key = $(this)
        .closest(".form_card")
        .find(".unique_key")
        .val();
      const section_data = formObject[section_key] ?? {};

      section_data[$(this).data("inp-reff")] = $(this).val();

      formObject[section_key] = section_data;

      FORM_DATA[section] = formObject;
    }

    updatePreviewer(FORM_DATA);
    useStorage(STORAGE_KEY, FORM_DATA);
  });

  $(".btn_save_resume").on("click", () => {
    updatePreviewer(FORM_DATA);
  });

  //- updatePreviewer()
  function updatePreviewer(data = {}) {
    $(".resume_previewer").load(
      "/resume/on_edit/" + TEMPLATE_MAIN,
      data,
      function () {
        resizePreviewer();

        if (!$("#page_loader").hasClass("loaded"))
          $("#page_loader").addClass("loaded");
      }
    );
  }

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
      const res = await useFetch("GET", "/resume/design_123/");

      if (!res) {
        return alert("Connections error: Please try again..");
      }

      const { data, response } = res;

      if (data) {
        formData = data;
      } else if (!response.ok || response.status !== 200) {
        return alert("Connections error: Please try again..");
      } else {
        // if -> set default layout
        LoadDefaultForm();
      }
    }

    FORM_DATA = formData;
    LoadFormData(formData);
    updatePreviewer(formData);
  }
  loadSavedData();

  // Download Resume
  $(".btn_resume_dd").on("click", async function (e) {
    const res = await useFetch(
      "POST",
      "/resume/on_edit/" + TEMPLATE_MAIN + "?dd=true",
      FORM_DATA
    );
    if (res) {
      alert("CV Downloaded Succ..");
    }
  });
});
