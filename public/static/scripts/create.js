/**
 * @author  Ankain Lesly <leeleslyank@gmail.com>
 * @package  Resume Generator Application
 * >>>
 * github https://github.com/ankain-lesly
 * portfolio https://lesly-chuo.letech-cg.com
 */

import { STORAGE_KEY } from "./config.js";
import { generateFormCard, RANGE_OBJECT } from "./form_objects.js";
import {
  useFetch,
  useStorage,
  useToast,
  setBtnAction as BA,
  handleAppTheme,
} from "./app_hooks.js";
handleAppTheme();
const displayThemeBtns = () => {
  let e = localStorage.getItem("app-theme") ?? "light",
    t = "dark" === e ? "fa-sun" : "fa-moon";
  $("._theme_text").text(e),
    $("._theme_icon").removeClass("fa-sun"),
    $("._theme_icon").removeClass("fa-moon"),
    $("._theme_icon").addClass(t);
};
$(".theme-btn").on("click", () => displayThemeBtns()),
  $(document).ready(function (e) {
    let t = !1;
    const a = {
      resume: $("#resume_main").val(),
      template: $("#template_main").val(),
    };
    let n = {};
    const o = {
      OBJECT_EDUCATION: {
        title: "Education",
        className: "education",
        form_object: "edu_object",
      },
      OBJECT_EXPERIENCE: {
        title: "Experience",
        className: "experience",
        form_object: "exp_object",
      },
      OBJECT_LANGUAGE: {
        title: "Language",
        className: "language",
        form_object: "lang_object",
      },
      OBJECT_SKILL: {
        title: "Skill",
        className: "skill",
        form_object: "skill_object",
      },
      OBJECT_HOBBY: {
        title: "Hobby",
        className: "hobby",
        form_object: "hobby_object",
      },
      OBJECT_SOCIAL: {
        title: "Social",
        className: "social",
        form_object: "social_object",
      },
    };
    $(document).on("click", ".btn_form_card_done", function (e) {
      $(this).closest(".form_card").removeClass("on_edit");
    }),
      $(document).on("click", ".btn_form_card_edit", function (e) {
        $(".form_card").removeClass("on_edit"),
          $(this).closest(".form_card").addClass("on_edit");
      }),
      $(document).on("click", ".btn_form_card_delete", function (e) {
        let t = $(this).closest(".form_card").find(".unique_key").val();
        if (t) {
          const e = $(this).closest(".area-step").data("section-title"),
            a = n[e],
            o = {};
          $.each(a, (e, a) => {
            t != e && (o[e] = a);
          }),
            (n[e] = o),
            useStorage(STORAGE_KEY, n),
            c(n),
            $(this).closest(".form_card").remove();
        }
      }),
      $(document).on("click", ".btn_form_card_add", function (e) {
        $(".form_card").removeClass("on_edit");
        const t = $(this),
          a = t.data("target"),
          n = t.data("form-object");
        $(a).append(generateFormCard("", {}, o[n], "on_edit"));
      }),
      $(document).on(
        "keyup, change",
        "#education, #position, .social_input",
        function (e) {
          console.log("Logging.."), s($(this), "group_caption");
        }
      ),
      $(document).on("keyup", ".hobby_input", function (e) {
        s($(this), "hobby_heading");
      }),
      $(document).on("change", ".range_title_input", function (e) {
        s($(this), "range_title");
      }),
      $(document).on("keyup", ".range_title_input", function (e) {
        s($(this), "range_title");
      });
    const s = (e, t) =>
      e.closest(".form_card").find(`.${t}`).text(e.val().trim());
    $(document).on("input", ".range_input", function (e) {
      const t = $(this),
        a = t.val(),
        n = RANGE_OBJECT[a] ?? "Make a choise",
        o = a + "% 100%";
      t.css("background-size", o);
      const s = t.closest(".form_card");
      s.find(".bubble").text(a),
        s.find(".pro_caption").text(n),
        s.find(".range_proficiency").text(n);
    });
    const i = () => {
      $(".education-main").html(""),
        $(".experience-main").html(""),
        $(".language-main").html(""),
        $(".skill-main").html(""),
        $(".hobby-main").html(""),
        $(".social-main").html(""),
        $(".education-main").append(
          generateFormCard("", [], o.OBJECT_EDUCATION, "on_edit")
        ),
        $(".experience-main").append(
          generateFormCard("", [], o.OBJECT_EXPERIENCE, "on_edit")
        ),
        $(".language-main").append(
          generateFormCard("", [], o.OBJECT_LANGUAGE, "on_edit")
        ),
        $(".skill-main").append(
          generateFormCard("", [], o.OBJECT_SKILL, "on_edit")
        ),
        $(".hobby-main").append(
          generateFormCard("", [], o.OBJECT_HOBBY, "on_edit")
        ),
        $(".social-main").append(
          generateFormCard("", [], o.OBJECT_SOCIAL, "on_edit")
        );
    };
    function c(e = {}) {
      $(".resume_previewer").load("/resume/render/" + a.template, e, () => {
        r(),
          $("#page_loader").hasClass("loaded") ||
            $("#page_loader").addClass("loaded");
      });
    }
    function r() {
      let e = $("#my_resume_wrapper").width(),
        t = $("#my_resume_main").width();
      if (t >= e) {
        let a = e / t;
        $("#my_resume_main").css("transform", `scale(${a})`);
        let n = $("#my_resume_main").height();
        $("#my_resume_wrapper").css("height", n * a),
          console.log("Scalling view...");
      }
    }
    $(document).on("blur", "[data-inp-reff]", function (e) {
      console.log("Typing ...");
      const t = $(this).closest(".area-step").data("section-title"),
        a = null == n[t] || "" == n[t] ? {} : n[t];
      if ("personal" === t) a[$(this).data("inp-reff")] = $(this).val();
      else {
        const n = $(this).closest(".form_card").find(".unique_key").val();
        if ("hobby" === t) a[n] = $(this).val();
        else {
          const t = a[n] ?? {};
          (t[$(this).data("inp-reff")] = e.target.checked
            ? "true"
            : $(this).val()
            ? $(this).val()
            : ""),
            (a[n] = t);
        }
      }
      (n[t] = a), useStorage(STORAGE_KEY, n), c(n);
    }),
      $(".refresh_view").on("click", () => c(n)),
      $("#page_loader").addClass("loaded"),
      window.addEventListener("resize", r),
      (async function () {
        let e;
        if (((e = useStorage(STORAGE_KEY)), !e)) {
          const t = await useFetch("GET", "/resume/" + a.resume + "/");
          if (!t)
            return (
              useToast(
                "Connections error: Loading default form interface 🐱‍🏍"
              ),
              i()
            );
          if (t.data) e = t.data;
          else {
            if (t.response.ok && 200 === t.response.status) return i();
            alert("Error getting data please try again..");
          }
        }
        var t;
        $.each(e, (t, a) => (e[t] = a && "" !== a ? a : {})),
          (n = e),
          (t = e),
          i(),
          $.each(t, (e, t) => {
            if ("personal" === e)
              $.each(t, (e, t) => {
                $(`[data-inp-reff="${e}"]`).val(t);
              });
            else if ("cover_photo" === e)
              $(".img-cover-profile").attr("src", "/uploads/covers/" + t);
            else if (t) {
              const a = o[`OBJECT_${e.toUpperCase()}`];
              if (!a) return;
              $(`.${e}-main`).html(""),
                $.each(t, (t, n) => {
                  $(`.${e}-main`).append(generateFormCard(t, n, a));
                });
            }
          }),
          c(e);
      })(),
      $(".btn_clear").on("click", () => {
        BA.name(".btn_clear"),
          BA.loading(),
          $.each($(".personal [data-inp-reff]"), (e, t) => {
            t.value = "";
          }),
          $(".img-cover-profile").attr("src", "/static/media/user.png"),
          (n = {}),
          useStorage(STORAGE_KEY, n),
          c(n),
          i(),
          BA.done();
      }),
      $(".btn_save_resume").on("click", () => {
        t ||
          ((t = !0),
          BA.name(".btn_save_resume"),
          BA.loading(),
          setTimeout(() => {
            l(n), BA.done(), (t = !1);
          }, 500));
      }),
      $(".btn_resume_dd").on("click", function (e) {
        BA.name(".btn_resume_dd"), BA.loading();
        const { jsPDF: t } = window.jspdf;
        var n = new t();
        let o = "Resume-" + a.template + ".pdf";
        var s = document.querySelector("#resume_design");
        n.html(s, {
          callback: function (e) {
            e.save(o), BA.done();
          },
          margin: [10, 10, 10, 10],
          autoPaging: "text",
          x: 0,
          y: 0,
          width: 125,
          windowWidth: 675,
        });
      }),
      $("#resume_photo").on("change", function (e) {
        BA.name(".btn_save_resume"), BA.loading();
        const t = $(this).prop("files")[0];
        if (!t) return;
        let o = window.URL.createObjectURL(t);
        const s = new FormData();
        s.append("image", t),
          s.append("cover_photo", "cover photo"),
          s.append("resume_id", a.resume),
          s.append("current", n.cover_photo ?? !1),
          $.ajax({
            url: "/resume/update/" + a.resume,
            method: "post",
            contentType: !1,
            processData: !1,
            cache: !1,
            data: s,
            success: function (e) {
              const t = JSON.parse(e) ?? !1;
              t &&
                t.success &&
                ((n.cover_photo = t.cover),
                c(n),
                useStorage(STORAGE_KEY, n),
                BA.name(".btn_save_resume"),
                BA.loading(),
                $(".img-cover-profile").attr("src", o),
                setTimeout(() => {
                  BA.done();
                }, 500));
            },
          });
      });
    const l = async (e) => {
      if ("XR-12345678-Lee" == a.resume)
        return useToast(
          "Ooop, You cannot save an untitled resume. Login to dashboard and create one. 🐱‍🏍"
        );
      const t = e;
      t.meta = a;
      const n = await useFetch("POST", "/resume/update/" + a.resume, t);
      n && n.data && n.data.success
        ? useToast("Resume saved.. 😊")
        : useToast("Failed to save data.. 🚩");
    };
    $(".use_template").on("click", async function (e) {
      let t = $(this).siblings("#use_main").val();
      const { data } = await useFetch("POST", "/resume/meta", {
        resume_id: a.resume,
        template_id: t,
        update_meta: "true",
      });
      // User
      data &&
        data.success &&
        (useToast("Template changed.. 😊"), (a.template = data.template), c(n));
      // No User
      data &&
        data.auth &&
        useToast("Oops, please create account to track template.. 🚩");
    }),
      $(".btn_close_unsigned").on("click", function (e) {
        $(".alert-unsigned").fadeOut();
      }),
      setTimeout(() => $(".alert-unsigned").addClass("show"), 1e4),
      $(".panel_btn").on("click", function (e) {
        $(".panel_btn").removeClass("active"), $(this).addClass("active");
        const t = $(this).data("target");
        $(".page_section").removeClass("on_page"),
          $(`.${t}`).addClass("on_page"),
          $(".area-step").removeClass("active");
      }),
      $(".control_action").on("click", function (e) {
        $(".area-step").removeClass("active");
        const t = $(this).data("form-section");
        $(`.${t}`).addClass("active"),
          $(`[data-section-title="${t}"]`).addClass("active");
      }),
      $(".btn_page_section").on("click", function (e) {
        $(".area-step").removeClass("active");
      }),
      $(".btn_panel").on("click", function (e) {
        let t = $(".side_panel");
        t.hasClass("active") ? t.removeClass("active") : t.addClass("active");
      }),
      $(".btn_preview").on("click", function (e) {
        $(".create-preview").fadeIn(), c(n);
      }),
      $(".close_mobile_preview").on("click", function (e) {
        $(".create-preview").fadeOut();
      });
  });
