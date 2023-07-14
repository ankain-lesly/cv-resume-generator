// import { token_id } from "./config.js";

// EDUCATION
const edu_object = {
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

// EXPERIENCE
const exp_object = {
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
};

// Generate Form Group
const generateFormGroup = (name, value, object) => {

  if (!object[name]["type"]) {
    return `<div class="form-group ${object[name]["classes"] ?? ""}">
        <label for="${name}">${object[name]["label"]}</label>
        <textarea id="${name}" data-inp-reff=".reff-${name}" cols="30" rows="2">${value}</textarea>
      </div>`;
  }

  return `<div class="form-group ${object[name]["classes"] ?? ""}">
      <label for="${name}">${object[name]["label"]}</label>
      <input type="${
        object[name]["type"]
      }" id="${name}" data-inp-reff=".reff-${name}" value="${value}" />
    </div>`;
};

// Generate Card
const generateFormCard = (data = null, config, className = "") => {
  const object = config.form_object === "edu_object" ? edu_object : exp_object;

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

  return `<!-- EDUCATIONS -->
  <div class="education-1 form_card ${config.className}-card ${className}">
    <!-- HEAD -->
    <div class="ed_head">
      <div class="flex between gap-1">
        <p>${config.title}</p>
        <span class="bbtn primary small btn_${config.className}_edit"><i class="fas fa-pencil-alt"></i></span>
      </div>
      <input type="hidden" id="ed_key" value="">
    </div>
    <!-- BODY -->
    <div class="ed_body">
      <div class="intro-group body">
        ${dataGroup}        
        <div class="card-options flex end gap-1 mt-1 col-span">
          <span class="bbtn primary small btn_${config.className}_delete"><i class="fas fa-trash"></i></span>
          <span class="bbtn secondary small btn_${config.className}_done"><i class="fas fa-check"></i> Done</span>
        </div>
      </div>
    </div>
  </div>`;
};
// module.exports = {
//   makeFetch,
// };
export { generateFormCard };
