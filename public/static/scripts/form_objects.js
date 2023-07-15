// import { token_id } from "./config.js";

// EDUCATION
const FORM_TEMPLATE = {
  edu_object: {
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
  },

  // EXPERIENCE
  exp_object: {
    position: { label: "Position", type: "text" },
    employer: { label: "Employer", type: "text" },
    start_date: { label: "Start date", type: "date" },
    end_date: { label: "End date", type: "date" },
    city: { label: "City", type: "text" },
    present: {
      label: "Present",
      type: "checkbox",
      classes: "flex pt-1 row-reverse",
    },
    description: { label: "Description", type: false, classes: "col-span" },
  },
  // LANGUAGE
  lang_object: {
    language: { label: "Language", type: "text", option: "class" },
    proficiency: { label: "Proficiency", type: "range" },
  },
  // SKILL
  skill_object: {
    skill: { label: "Skill", type: "text", option: "class" },
    proficiency: { label: "Proficiency", type: "range" },
  },
  hobby_object: {
    hobby: { label: "Hobby", type: "text", classes: "col-span" },
  },
};

// Generate Form Group
const generateFormGroup = (name, value, {inp_type, inp_label, inp_classes} => {

  if (!inp_type) {
    return `<div class="form-group ${inp_classes ?? ""}">
        <label for="${name}">${inp_label}</label>
        <textarea id="${name}" data-inp-reff=".reff-${name}" cols="30" rows="2">${value}</textarea>
      </div>`;
  } else if (inp_type === "range") {
    return `
      <div class="form-group mt-1">
        <label for="${name}">${inp_label}</label>
        <div class="rang_setup flex gap-2 start">
          <input
            type="range"
            class="range_input flex-1"
            id="${name}"
            value="0"
            step="20"
            data-inp-reff=".reff-${name}"
          />
          <div class="info flex start gap-1">
            <span class="detail bubble" id="test_input"
              >0</span
            >
            <small class="pro_caption">Make a choice</small>
          </div>
        </div>
      </div>
    `;
  }

  return `<div class="form-group ${inp_classes ?? ""}">
      <label for="${name}">${inp_label}</label>
      <input type="${
        inp_type
      }" id="${name}" data-inp-reff=".reff-${name}" ${
    inp_name]["option"] && inp_name]["option"] === "class"
      ? 'class="font-size-small range_title_input"'
      : ""
  } ${name === "hobby" ? "class='hobby_input'" : ""} value="${value}" />
    </div>`;
};

// Generate Card
const generateFormCard = (data = null, config, className = "") => {
  const object =
    FORM_TEMPLATE[config.form_object] ?? alert("Error getting object data...");

  let dataGroup = "";
  if (data)
    $.each(data, (key, value) => {
      // console.log(key, value);
      dataGroup += generateFormGroup(key, value, object);
    });
  else
    $.each(object, (key, value) => {
      // console.log(key, value);
      dataGroup += generateFormGroup(key, "", object);
    });

  let headContent = "";

  if (config.className === "language" || config.className === "skill") {
    headContent = `<div class="head_caption">
      <p class="range_title">[${config.title}]</p>
      <small class="range_proficiency"></small>
    </div>`;
  }else {
    headContent = `<p class="${ config.className === "hobby" ? "hobby_heading" : "group_caption"}">${config.title}</p>`
  }

  return `<!-- EDUCATIONS -->
  <div class="education-1 form_card ${config.className}-card ${className}">
    <!-- HEAD -->
    <div class="ed_head">
      <div class="flex between gap-1">
        ${headContent}
        <span class="bbtn primary small btn_form_card_edit"><i class="fas fa-pencil-alt"></i></span>
      </div>
      <input type="hidden" id="ed_key" value="">
    </div>
    <!-- BODY -->
    <div class="ed_body">
      <div class="intro-group${headContent ? "-2" : ""}">
        ${dataGroup}        
        <div class="card-options flex end gap-1 mt-1 col-span">
          <span class="bbtn primary small btn_form_card_delete"><i class="fas fa-trash"></i></span>
          <span class="bbtn secondary small btn_form_card_done"><i class="fas fa-check"></i> Done</span>
        </div>
      </div>
    </div>
  </div>`;
};
// module.exports = {
//   makeFetch,
// };
export { generateFormCard };
