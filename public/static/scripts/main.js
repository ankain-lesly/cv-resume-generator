/**
 * @author  Ankain Lesly <leeleslyank@gmail.com>
 * @package  Resume Generator Application
 * >>>
 * github https://github.com/ankain-lesly
 * portfolio https://lesly-chuo.letech-cg.com
 */

import { APP_ROOT, STORAGE_KEY } from "./config.js";
import {
  useFetch,
  useToken,
  useToast,
  useStorage,
  setBtnAction as BA,
  handleAppTheme,
} from "./app_hooks.js";
handleAppTheme();
let isLoaded = !1,
  isLoading = !1;
async function LoadTemplates() {
  let e = 0;
  const t = await useFetch("GET", "/api/templates/resume?api=true");
  t && t.data
    ? setTimeout(() => {
        $(".templates-main").html(""),
          $.each(t.data, (t, a) => {
            let s = `\n      <div class="card">\n        <input type="radio" id="${a.template_id}" id="meta_template" name="meta_template" class="temp_input" value="${a.template_id}" required>\n        <label for="${a.template_id}" class="temp_image">\n          <img class="thumbnail" src="/resumes/thumbnails/${a.thumbnail}" alt="Template Thumbnail">\n        </label>\n        <span class="btn_preview flex" data-reff="${e}"><i class="fas fa-camera"></i></span>\n      </div>`;
            $(".templates-main").append(s),
              e++,
              $(".templates-main ~ .actions").show(),
              (isLoaded = !0);
          });
      }, 800)
    : $(".templates-main").html(
        '\n    <p class="txt-center clr-danger" style="grid-column: span 5">\n    <span>Error Loading templates</span><br><br>\n    <span class="btn btn-p reload_templates">Retry</span>\n    </p>'
      );
}
$(".btn-sitebar").on("click", () => {
  $(".side-bar").toggleClass("active");
}),
  $(".btn-close-sidebar").on("click", () => {
    $(".side-bar").toggleClass("active");
  }),
  $(document).on("click", ".toast_close_btn", (e) =>
    $(".Toast_container").html("")
  ),
  $("[data-step]").on("click", function (e) {
    const t = $(this).data("step");
    t &&
      ($(".create-step").removeClass("active"),
      $(".create-step." + t).addClass("active"),
      "templates" !== t || isLoaded || LoadTemplates());
  }),
  $(document).on("click", ".btn_preview", function (e) {
    const t = [...$(".thumbnail")];
    let a = $(this).data("reff"),
      s = ($(this).closest(".card").find(".temp_input"), t[a]);
    $(".template_previewer").fadeIn(),
      $("#preview_image").attr("src", s.src),
      $(".show_temp_left").on("click", function (e) {
        a <= 0 && (a = t.length),
          a--,
          $("#preview_image").fadeOut(),
          (s = t[a]),
          $("#preview_image").fadeIn(),
          $("#preview_image").attr("src", s.src);
      }),
      $(".show_temp_right").on("click", function (e) {
        a >= t.length - 1 && (a = -1),
          a++,
          $("#preview_image").fadeOut(),
          (s = t[a]),
          $("#preview_image").fadeIn(),
          $("#preview_image").attr("src", s.src);
      }),
      $(".btn_select").on("click", function (e) {
        ($(s).closest(".card").find(".temp_input")[0].checked = !0),
          $(".template_previewer").fadeOut();
      }),
      $(".close_previewer").on("click", function (e) {
        $(".template_previewer").fadeOut();
      });
  }),
  $(document).on("click", ".reload_templates", (e) => LoadTemplates()),
  $(".close-main").on("click", () => $(".popup-main").hide()),
  $(".create_resume").on("click", () => $(".popup-main").show()),
  $(".create_meta").on("click", async (e) => {
    e.preventDefault();
    const t = {
      title: $("#meta_title").val().trim(),
      description: $("#meta_description").val().trim(),
      template: $("input[name='meta_template']:checked").val() ?? "".trim(),
    };
    if (t.title.length <= 0) return useToast("Please enter your Resume Title.");
    if (t.description.length <= 0)
      return useToast("Please enter your Resume Description.");
    if (t.template.length <= 0)
      return useToast("Please select a Resume Design.");
    t.token = useToken();
    const a = await submitFormData(t, "/resume/meta");
    if ((BA.done(), (isLoading = !1), !a))
      return useToast("Error making requests, please try again");
    const { data: s, response: i } = a;
    if (!s.success) return useToast("Error creating resume, please try again");
    i.ok &&
      s.success &&
      (useToast("Resume created successfully. Setting up interface 🐱‍🏍"),
      setTimeout(() => {
        window.location = "/resume/edit/" + s.resume + "?basis=new-resume";
      }, 2e3));
  });
const submitFormData = async (e, t, a = "/") => {
  if (!isLoading)
    return (
      BA.name(),
      BA.loading(),
      (isLoading = !0),
      await useFetch("POST", APP_ROOT + t, e)
    );
};
function useQueryParams(e = "") {
  const t = new URL(window.location);
  let a = t.search,
    s = t.href;
  if (
    ($.each($(".side-bar-links a"), (e, t) => {
      t.href === s && t.classList.add("active");
    }),
    a.includes("resume"))
  )
    return $(".popup-main").show();
}
useQueryParams(),
  $("#profile_photo").change(function (e) {
    const t = $(this).prop("files")[0];
    if (t) {
      let e = window.URL.createObjectURL(t);
      $(this).siblings(".image-holder").find("img").attr("src", e),
        $(".save-profile-btn").show();
    }
  });
