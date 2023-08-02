// User Authentication - JS API Endpoints
import { APP_ROOT, STORAGE_KEY } from "./config.js";
import {
  useFetch,
  useToken,
  useToast,
  useStorage,
  setBtnAction as BA,
  handleAppTheme,
} from "./app_hooks.js";

// App Theme()
handleAppTheme();
// load templates
let isLoaded = false;
let isLoading = false;
// let object = [
//   {
//     id: 134,
//     src: "t1.jpg",
//   },
//   {
//     id: 513,
//     src: "t2.jpg",
//   },
//   {
//     id: 133,
//     src: "t3.jpg",
//   },
// ];
// Dashboard
// Menu -- sidebar
$(".btn-sitebar").on("click", () => {
  $(".side-bar").toggleClass("active");
});
$(".btn-close-sidebar").on("click", () => {
  $(".side-bar").toggleClass("active");
});
// TOAST ACTION
$(document).on("click", ".toast_close_btn", (e) =>
  $(".Toast_container").html("")
);

// CREATE STEP
$("[data-step]").on("click", function (e) {
  const step = $(this).data("step");
  if (!step) return;
  $(".create-step").removeClass("active");
  // console.log(step);
  $(".create-step." + step).addClass("active");
  if (step === "templates" && !isLoaded) LoadTemplates();
});

// TEMPLATE PREVIEWER
$(document).on("click", ".btn_preview", function (e) {
  const templates = [...$(".thumbnail")];
  let reff = $(this).data("reff");
  let input = $(this).closest(".card").find(".temp_input");

  let currentImage = templates[reff];

  $(".template_previewer").fadeIn();

  $("#preview_image").attr("src", currentImage.src);

  // BACKWARDS
  $(".show_temp_left").on("click", function (e) {
    if (reff <= 0) reff = templates.length;
    reff--;

    $("#preview_image").fadeOut();
    currentImage = templates[reff];
    $("#preview_image").fadeIn();

    $("#preview_image").attr("src", currentImage.src);
  });
  // FORWARDS
  $(".show_temp_right").on("click", function (e) {
    if (reff >= templates.length - 1) reff = -1;
    reff++;

    $("#preview_image").fadeOut();
    currentImage = templates[reff];
    $("#preview_image").fadeIn();

    $("#preview_image").attr("src", currentImage.src);
  });
  // SELECT
  $(".btn_select").on("click", function (e) {
    $(currentImage).closest(".card").find(".temp_input")[0].checked = true;
    $(".template_previewer").fadeOut();
  });
  // CLOSE PREV
  $(".close_previewer").on("click", function (e) {
    $(".template_previewer").fadeOut();
  });
});

// DROP DOWN NAVIGATIONS
// $(".drop-down-head").on("click", function () {
//   const $droptDown = $(this).closest(".drop-down");
//   $droptDown.toggleClass("active");

//   if ($droptDown.hasClass("active")) $(".drop-down-body").slideDown();
//   else $(".drop-down-body").slideUp();
// });
$(document).on("click", ".reload_templates", (e) => LoadTemplates());
async function LoadTemplates() {
  let reff = 0;
  const object = await useFetch("GET", "/api/templates/resume?api=true");
  // object = null;
  if (!object || !object.data) {
    $(".templates-main").html(`
    <p class="txt-center clr-danger" style="grid-column: span 5">
    <span>Error Loading templates</span><br><br>
    <span class="btn btn-p reload_templates">Retry</span>
    </p>`);

    return;
  }
  setTimeout(() => {
    $(".templates-main").html("");
    $.each(object.data, (key, data) => {
      console.log(data);
      let layout = `
      <div class="card">
        <input type="radio" id="${data.template_id}" id="meta_template" name="meta_template" class="temp_input" value="${data.template_id}" required>
        <label for="${data.template_id}" class="temp_image">
          <img class="thumbnail" src="/resumes/thumbnails/${data.thumbnail}" alt="Template Thumbnail">
        </label>
        <span class="btn_preview flex" data-reff="${reff}"><i class="fas fa-camera"></i></span>
      </div>`;

      $(".templates-main").append(layout);
      reff++;
      $(".templates-main ~ .actions").show();
      isLoaded = true;
    });
  }, 800);
}

// close Pop
$(".close-main").on("click", () => $(".popup-main").hide());
$(".create_resume").on("click", () => $(".popup-main").show());
// Create Meta
$(".create_meta").on("click", async (e) => {
  e.preventDefault();

  const formData = {
    title: $("#meta_title").val().trim(),
    description: $("#meta_description").val().trim(),
    template: $("input[name='meta_template']:checked").val() ?? "".trim(),
  };

  if (formData.title.length <= 0)
    return useToast("Please enter your Resume Title.");
  if (formData.description.length <= 0)
    return useToast("Please enter your Resume Description.");
  if (formData.template.length <= 0)
    return useToast("Please select a Resume Design.");

  formData.token = useToken();
  const res = await submitFormData(formData, "/resume/meta");

  BA.done();

  isLoading = false;
  if (!res) return useToast("Error making requests, please try again");

  const { data, response } = res;
  if (!data.success) return useToast("Error creating resume, please try again");

  if (response.ok && data.success) {
    // resolve_form() && Redirect()
    useToast("Resume created successfully. Setting up interface 🐱‍🏍");
    useStorage(STORAGE_KEY, {});
    setTimeout(() => {
      window.location = "/resume/create/" + data.resume + "?reff=new-resume";
    }, 2000);
  }
});
const submitFormData = async (formData, endpoint, redirect_route = "/") => {
  if (isLoading) return;

  BA.name();
  BA.loading();

  isLoading = true;
  return await useFetch("POST", APP_ROOT + endpoint, formData);
};

// GET pARAMS
function useQueryParams(key = "") {
  const url = new URL(window.location);
  let params = url.search;
  let path = url.href;

  $.each($(".side-bar-links a"), (key, link) => {
    if (link.href === path) {
      // console.log(path);
      // console.log(link.href);
      link.classList.add("active");
    }
  });
  // if (key) return url.searchParams[0] ?? false;

  if (params.includes("resume")) return $(".popup-main").show();
}
useQueryParams();

// profile photo

$("#profile_photo").change(function (e) {
  const file = $(this).prop("files")[0];
  // const file = document.getElementById('p_img').files[0]
  if (file) {
    let source = window.URL.createObjectURL(file);
    $(this).siblings(".image-holder").find("img").attr("src", source);
    $(".save-profile-btn").show();
  }
});
