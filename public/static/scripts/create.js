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

// EDUCATION
const ed_object = {
  education: { label: "Education", type: "text" },
  school: { label: "School", type: "text" },
  start_date: { label: "Start date", type: "date" },
  end_date: { label: "End date", type: "date" },
  city: { label: "City", type: "text" },
  present: {
    label: "Present",
    type: "checkbox",
    classes: "flex pt-1 row-reverse",
  },
  description: { label: "Description", type: false, classes: "col-span" },
};
const generateFormGroup = (name, value) => {
  if (!ed_object[name]["type"]) {
    return `<div class="form-group ${ed_object[name]["classes"] ?? ""}">
        <label for="${name}">${ed_object[name]["label"]}</label>
        <textarea id="${name}" data-inp-reff=".reff-${name}" cols="30" rows="2">${value}</textarea>
      </div>`;
  }

  return `<div class="form-group ${ed_object[name]["classes"] ?? ""}">
      <label for="${name}">${ed_object[name]["label"]}</label>
      <input type="${
        ed_object[name]["type"]
      }" id="${name}" data-inp-reff=".reff-${name}" value="${value}" />
    </div>`;
};

const generateEducationTemplate = (data = null, className = "") => {
  let dataGroup = "";
  if (data)
    $.each(data, (key, value) => {
      // console.log(key, value);
      dataGroup += generateFormGroup(key, value);
    });
  else
    $.each(ed_object, (key, value) => {
      // console.log(key, value);
      dataGroup += generateFormGroup(key, "");
    });

  return `<!-- EDUCATIONS -->
  <div class="education-1 education-card ${className}">
    <!-- HEAD -->
    <div class="ed_head">
      <div class="flex between gap-1">
        <p>Education</p>
        <span class="bbtn primary small btn_education_edit"><i class="fas fa-pencil-alt"></i></span>
      </div>
      <input type="hidden" id="ed_key" value="">
    </div>
    <!-- BODY -->
    <div class="ed_body">
      <div class="intro-group body">
        ${dataGroup}        
        <div class="card-options flex end gap-1 mt-1 col-span">
          <span class="bbtn primary small btn_education_delete"><i class="fas fa-trash"></i></span>
          <span class="bbtn secondary small btn_education_done"><i class="fas fa-check"></i> Done</span>
        </div>
      </div>
    </div>
  </div>`;
};

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
