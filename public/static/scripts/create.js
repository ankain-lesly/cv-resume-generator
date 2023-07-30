// Custom Objects
import { STORAGE_KEY } from "./config.js";
import { generateFormCard, RANGE_OBJECT } from "./form_objects.js";
import {
  useFetch,
  useStorage,
  useToast,
  setBtnAction as BA,
} from "./app_hooks.js";

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
    $(this).closest(".form_card").remove();
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
  $(document).on("change", ".range_title_input", function (e) {
    $(this)
      .closest(".form_card")
      .find(".range_title")
      .text(e.target.value.trim());
  });
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
      } else {
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
    // console.log(FORM_DATA);
    const section = $(this).closest(".area-step").data("section-title");
    const formObject = FORM_DATA[section] ?? {};
    // console.log(formObject);
    // return;
    if ($(this).val() === "") return;
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
        section_data[$(this).data("inp-reff")] = $(this).val();
        formObject[section_key] = section_data;
      }
    }
    FORM_DATA[section] = formObject;
    updatePreviewer(FORM_DATA);
    useStorage(STORAGE_KEY, FORM_DATA);
  });

  //- updatePreviewer()
  function updatePreviewer(data = {}) {
    // data["meta"] = META_DATA;
    $(".resume_previewer").load(
      "/resume/edit/" + META_DATA.template,
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
        alert("Connections error: Please try again..");
        LoadDefaultForm();
        return;
      }

      if (res.data) {
        formData = res.data;
      } else if (!res.response.ok || res.response.status !== 200) {
        alert("Error getting data please try again..");
      } else {
        LoadDefaultForm();
      }
    }
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
  // Download Resume
  $(".btn_resume_dd").on("click", function (e) {
    BA.name(".btn_resume_dd");
    BA.loading();
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF("p", "mm", [1500, 1400]);

    var pdfjs = document.querySelector("#resume_design");

    doc.html(pdfjs, {
      callback: function (doc) {
        doc.save("My-Resume-USERNAME.pdf");
        BA.done();
      },
      x: 20,
      y: 20,
    });
  });

  // CHANGE COVER PHOTO
  $("#resume_photo").on("change", function (e) {
    BA.name(".btn_save_resume");
    BA.loading();
    const file = $(this).prop("files")[0];

    if (!file) return;

    let source = window.URL.createObjectURL(file);
    $(".img-cover-profile").attr("src", source);

    const formObj = new FormData();
    formObj.append("image", file);
    formObj.append("cover_photo", "cover photo");
    formObj.append("resume_id", META_DATA.resume);

    $.ajax({
      url: "/resume/create/" + META_DATA.resume,
      method: "post",
      contentType: false,
      processData: false,
      cache: false,
      data: formObj,
      success: function (res) {
        const data = JSON.parse(res) ?? false;
        if (data && data.success) {
          FORM_DATA["cover_photo"] = data.cover;
          useStorage(STORAGE_KEY, FORM_DATA);

          BA.name(".btn_save_resume");
          BA.loading();

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
    const formData = data;
    formData.meta = META_DATA;

    const res = await useFetch(
      "POST",
      "/resume/create/" + META_DATA.resume,
      formData
    );

    if (res.data && res.data.success) {
      useToast("Resume saved.. 😊");
    }
  };
});
