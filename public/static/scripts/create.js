import { generateFormCard } from "./form_objects.js";

// Form section Objects
const FORM_OBJECT_EDU = {
  title: "Education",
  className: "education",
  form_object: "edu_object",
};
const FORM_OBJECT_EXP = {
  title: "W Experience",
  className: "experience",
  form_object: "exp_object",
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

function setAccordion(Elements, targetEl, className = "active") {
  $(Elements).removeClass(className);
  targetEl.addClass(className);
  $(".form_card").removeClass("on_edit");
}

// const div = document.createElement("div");
// const design = generateFormCard();
// div.innerHTML = design;

// console.log(div);
setTimeout(() => {
  $(".education-main").append(generateFormCard("", FORM_OBJECT_EDU));
  $(".experience-main").append(generateFormCard("", FORM_OBJECT_EXP));
}, 1000);
// console.log(generateFormCard());

// Education Logic
// Done
$(document).on("click", ".btn_education_done", (e) =>
  $(".education-card").removeClass("on_edit")
);
// Edit
$(document).on("click", ".btn_education_edit", function (e) {
  $(".education-card").removeClass("on_edit");
  $(this).closest(".education-card").addClass("on_edit");
});
$(document).on("click", ".btn_education_delete", function (e) {
  $(this).closest(".education-card").remove();
});
$(document).on("click", ".btn_education_add", function (e) {
  $(".education-card").removeClass("on_edit");
  $(".education-main").append(
    generateFormCard(null, FORM_OBJECT_EDU, "on_edit")
  );
});

// Experience Logic
// Done
$(document).on("click", ".btn_experience_done", (e) =>
  $(".experience-card").removeClass("on_edit")
);
// Edit
$(document).on("click", ".btn_experience_edit", function (e) {
  $(".experience-card").removeClass("on_edit");
  $(this).closest(".experience-card").addClass("on_edit");
});
// Delete
$(document).on("click", ".btn_experience_delete", function (e) {
  $(this).closest(".experience-card").remove();
});
// Add
$(document).on("click", ".btn_experience_add", function (e) {
  $(".experience-card").removeClass("on_edit");
  $(".experience-main").append(
    generateFormCard(null, FORM_OBJECT_EXP, "on_edit")
  );
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
function handleInputChange(e) {
  const target = e.target;
  const val = target.value;

  const size = val + "% 100%";
  target.style.backgroundSize = size;

  numberInput.textContent = val;

  pro_caption.textContent = rangeObject[val] ?? "Make a choise";
}
