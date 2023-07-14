import { generateEducationTemplate } from "./form_objects.js";
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

function setAccordion(Elements, targetEl, className = "active") {
  $(Elements).removeClass(className);
  targetEl.addClass(className);
}

// const div = document.createElement("div");
// const design = generateEducationTemplate();
// div.innerHTML = design;

// console.log(div);
setTimeout(() => {
  $(".education-main").append(generateEducationTemplate());
}, 1000);
// console.log(generateEducationTemplate());

// Education Logic
// Done
$(document).on("click", ".btn_education_done", (e) =>
  $(".education-card").removeClass("on_edit")
);
// Edit
$(document).on("click", ".btn_education_edit", function (e) {
  $(this).closest(".education-card").addClass("on_edit");
});
$(document).on("click", ".btn_education_delete", function (e) {
  $(this).closest(".education-card").remove();
});
$(document).on("click", ".btn_education_add", function (e) {
  $(".education-card").removeClass("on_edit");
  $(".education-main").append(generateEducationTemplate(null, "on_edit"));
});
