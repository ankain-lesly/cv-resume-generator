// import { token_id } from "./config.js";

// input range response
const RANGE_OBJECT = {
  0: "Make a choice",
  20: "Beginner",
  40: "Moderate",
  60: "Good",
  80: "Very good",
  100: "Excellent",
};
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
  social_object: {
    social: { label: "Social", type: "select", option: "class" },
    handle: { label: "Handle", type: "text" },
  },
  hobby_object: {
    hobby: { label: "Hobby", type: "text", classes: "col-span" },
  },
};
// Generate Form Group
const generateFormGroup = (name, value, options) => {
  // console.log(name, value, options);
  if (!options["type"]) {
    return `<div class="form-group ${options["classes"] ?? ""}">
        <label for="${name}">${options["label"]}</label>
        <textarea id="${name}" data-inp-reff="${name}" cols="30" rows="2">${value}</textarea>
      </div>`;
  } else if (options["type"] === "select") {
    // console.log(value);
    return `<div class="form-group ${options["classes"] ?? ""}">
        <label for="${name}">${options["label"]}</label>
        <select id="${name}" data-inp-reff="${name}" class="font-size-small range_title_input mb-1">
          <option></option>
          <option ${value === "Facebook" ? "selected" : ""}>Facebook</option>
          <option ${value === "Instagram" ? "selected" : ""}>Instagram</option>
          <option ${value === "Twitter" ? "selected" : ""}>Twitter</option>
          <option ${value === "LinkedIn" ? "selected" : ""}>LinkedIn</option>
          <option ${value === "Tiktok" ? "selected" : ""}>Tiktok</option>
          <option ${value === "Pinterest" ? "selected" : ""}>Pinterest</option>
          <option ${value === "YouTube" ? "selected" : ""}>YouTube</option>
          <option ${value === "Reddit" ? "selected" : ""}>Reddit</option>
          <option ${value === "WhatsApp" ? "selected" : ""}>WhatsApp</option>
          <option ${value === "Website" ? "selected" : ""}>Website</option>
          <option ${value === "Others" ? "selected" : ""}>Others</option>
        </select>
      </div>`;
  } else if (options["type"] === "range") {
    // console.log(value);
    return `
      <div class="form-group mt-1">
        <label for="${name}">${options["label"]}</label>
        <div class="rang_setup flex gap-2 start">
          <input
            type="range"
            class="range_input flex-1"
            id="${name}"
            value="${value ? value : 0}"
            step="20"
            data-inp-reff="${name}"
          />
          <div class="info flex start gap-1">
            <span class="detail bubble" id="test_input"
              >${value ? value : 0}</span
            >
            <small class="pro_caption">${
              value ? RANGE_OBJECT[value] : "Make a choice"
            }</small>
          </div>
        </div>
      </div>
    `;
  }

  return `<div class="form-group ${options["classes"] ?? ""}">
      <label for="${name}">${options["label"]}</label>
      <input type="${options["type"]}" id="${name}" data-inp-reff="${name}" 
      class="font-size-small 
      ${
        options["option"] && options["option"] === "class"
          ? "range_title_input"
          : ""
      }
      
      "
      ${name === "hobby" ? "class='hobby_input'" : ""} value="${value}" />
    </div>`;
  // return `<div class="form-group ${options["classes"] ?? ""}">
  //     <label for="${name}">${options["label"]}</label>
  //     <input type="${options["type"]}" id="${name}" data-inp-reff="${name}" ${
  //   options["option"] && options["option"] === "class"
  //     ? 'class="font-size-small range_title_input"'
  //     : ""
  // } ${name === "hobby" ? "class='hobby_input'" : ""} value="${value}" />
  //   </div>`;
};

// Generate Card
const generateFormCard = (unique_key, data = [], config, className = "") => {
  const object = FORM_TEMPLATE[config.form_object] ?? [];

  let key_id = new Date().getTime();
  // rand_id = Math.floor(Math.random() * 100);

  let dataGroup = "",
    headContent = "",
    sectionTitle = "";

  $.each(object, (key, options) => {
    let input_value = "";
    if (object.hobby) {
      input_value = data.length ? data : "";
    } else {
      input_value = data[key] ? data[key] : "";
    }
    // console.log(data);
    dataGroup += generateFormGroup(key, input_value, options);
  });

  if (config.className === "education") {
    sectionTitle = data.education ? data.education : "[" + config.title + "]";
  } else if (config.className === "experience") {
    sectionTitle = data.position ? data.position : "[" + config.title + "]";
  } else if (config.className === "language") {
    sectionTitle = data.language ? data.language : "[" + config.title + "]";
  } else if (config.className === "skill") {
    sectionTitle = data.skill ? data.skill : "[" + config.title + "]";
  } else if (config.className === "social") {
    sectionTitle = data.social ? data.social : "[" + config.title + "]";
  } else if (config.className === "hobby") {
    sectionTitle = data ? data : "[" + config.title + "]";
  }

  if (object.proficiency) {
    headContent = `<div class="head_caption">
      <p class="range_title">${sectionTitle}</p>
      <small class="range_proficiency"></small>
    </div>`;
  } else {
    headContent = `<p class="${
      config.className === "hobby" ? "hobby_heading" : "group_caption"
    }">${sectionTitle}</p>`;
  }

  return `<!-- EDUCATIONS -->
  <div class="education-1 form_card ${config.className}-card ${className}">
    <!-- HEAD -->
    <div class="ed_head">
      <div class="flex between gap-1">
        ${headContent}
        <span class="bbtn primary small btn_form_card_edit"><i class="fas fa-pencil-alt"></i></span>
      </div>
      <input type="hidden" class="unique_key" value="${
        unique_key ? unique_key : "UU-" + key_id
      }">
    </div>
    <!-- BODY -->
    <div class="ed_body">
      <div class="intro-group${
        object.proficiency || object.social ? "-2" : ""
      }">
        ${dataGroup}        
        <div class="card-options flex end gap-1 mt-1 col-span">
          <span class="bbtn primary small btn_form_card_delete"><i class="fas fa-trash"></i></span>
          <span class="bbtn secondary small btn_form_card_done"><i class="fas fa-check"></i> Done</span>
        </div>
      </div>
    </div>
  </div>`;
};
export { generateFormCard, RANGE_OBJECT };
