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
const generateFormGroup = (name, value, object) => {
  // console.log(object);
  if (!object[name]["type"]) {
    return `<div class="form-group ${object[name]["classes"] ?? ""}">
        <label for="${name}">${object[name]["label"]}</label>
        <textarea id="${name}" data-inp-reff=".reff-${name}" cols="30" rows="2">${value}</textarea>
      </div>`;
  } else if (object[name]["type"] === "range") {
    return `
      <div class="form-group mt-1">
        <label for="${name}">${object[name]["label"]}</label>
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

  return `<div class="form-group ${object[name]["classes"] ?? ""}">
      <label for="${name}">${object[name]["label"]}</label>
      <input type="${
        object[name]["type"]
      }" id="${name}" data-inp-reff=".reff-${name}" ${
    object[name]["option"] && object[name]["option"] === "class"
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

  let headContent = null;

  if (config.className === "language" || config.className === "skill") {
    headContent = `<div class="head_caption">
      <p class="range_title">[${config.title}]</p>
      <small class="range_proficiency"></small>
    </div>`;
  }

  return `<!-- EDUCATIONS -->
  <div class="education-1 form_card ${config.className}-card ${className}">
    <!-- HEAD -->
    <div class="ed_head">
      <div class="flex between gap-1">
        ${
          headContent
            ? headContent
            : `<p class="${
                config.className === "hobby" ? "hobby_heading" : ""
              }">${config.title}</p>`
        }
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
