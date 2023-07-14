import { generateFormCard } from "./form_objects.js";

// Form section Objects
const FORM_OBJECTS = {
  OBJECT_EDU: {
    title: "Education",
    className: "education",
    form_object: "edu_object",
  },
  OBJECT_EXP: {
    title: "Experience",
    className: "experience",
    form_object: "exp_object",
  },
  OBJECT_LANG: {
    title: "Language",
    className: "language",
    form_object: "lang_object",
  },
  OBJECT_SKILL: {
    title: "Skill",
    className: "skill",
    form_object: "skill_object",
  },
  OBJECT_HOB: {
    title: "Hobby",
    className: "hobby",
    form_object: "hobby_object",
  },
};
// Form Sections Accord
$(".area-step .head").on("click", function (e) {
  $(".area-step .form-content").slideUp();
  setAccordion(".area-step", $(this).closest(".area-step"));

  let $content = $(this).siblings(".form-content");
  if ($content.hasClass("c-shown")) {
    $content.removeClass("c-shown").slideUp();
  } else {
    $content.addClass("c-shown").slideDown();
  }
});
// Set Accordion
function setAccordion(Elements, targetEl, className = "active") {
  $(Elements).removeClass(className);
  targetEl.addClass(className);
  $(".form_card").removeClass("on_edit");
}

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

  $(target).append(generateFormCard(null, FORM_OBJECTS[object], "on_edit"));
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

// Hobbie
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
setTimeout(() => {
  $(".education-main").append(generateFormCard("", FORM_OBJECTS["OBJECT_EDU"]));
  $(".experience-main").append(
    generateFormCard("", FORM_OBJECTS["OBJECT_EXP"])
  );
}, 1000);
