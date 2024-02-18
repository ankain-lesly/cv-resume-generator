/**
 * @author  Ankain Lesly <leeleslyank@gmail.com>
 * @package  Resume Generator Application
 * >>>
 * github https://github.com/ankain-lesly
 * portfolio https://lesly-chuo.letech-cg.com
 */

import { useFetch, useToken, useStorage } from "./app_hooks.js";
import { APP_ROOT } from "./config.js";
let isLoading = !1;
$("#signup_form").on("submit", async (e) => {
  e.preventDefault();
  const s = {};
  (s.username = e.target.username.value.trim()),
    (s.email = e.target.email.value.trim()),
    (s.phone = e.target.phone.value.trim()),
    (s.password = e.target.password.value.trim()),
    (s.confirm_password = e.target.confirm_password.value.trim()),
    (s.keep_alive = e.target.keep_alive.checked),
    submitFormData(s, "/auth/signup");
}),
  $("#login_form").on("submit", async (e) => {
    e.preventDefault();
    const s = {};
    (s.username = e.target.username.value.trim()),
      (s.password = e.target.password.value.trim()),
      (s.keep_alive = e.target.keep_alive.checked),
      submitFormData(s, "/auth/login");
  }),
  $("#reset_form").on("submit", async (e) => setBtnLoading());
const submitFormData = async (e, s, r = "/app/") => {
  if (isLoading) return;
  setBtnLoading();
  const t = await useFetch("POST", APP_ROOT + s, e);
  if (!t) {
    return errorMessage("Error making requests, please try again");
  }
  const { data: o, response: a } = t;
  return o.errors
    ? displayFormErrors(o.errors)
    : !o.errors && o.message
    ? errorMessage(o.message)
    : void (
        a.ok &&
        200 === a.status &&
        (useToken(o._sess_token),
        useStorage("_reff", o._reff ?? !1),
        (window.location = r))
      );
};
function displayFormErrors(e) {
  $.each(e, (e, s) => {
    const r = $(`#${e}`).closest(".form-group");
    r.addClass("error"), r.find(".status-msg").text(s.errors[0]);
  }),
    $(".form-message").removeClass("error"),
    setBtnDone();
}
function errorMessage(e) {
  $(".form-message").addClass("error").text(e),
    $(".form-message")[0].scrollIntoView(),
    setBtnDone();
}
function setBtnLoading() {
  (isLoading = !0), $(".form_btn").addClass("process");
}
function setBtnDone() {
  (isLoading = !1), $(".form_btn").removeClass("process");
}
$("form input").on("keyup", function (e) {
  setTimeout(() => {
    $(this).closest(".form-group").removeClass("error");
  }, 500);
}),
  $("form input").on("blur", function (e) {
    setTimeout(() => {
      $(this).closest(".form-group").removeClass("error");
    }, 500);
  }),
  $("[data-toggle-type]").on("click", function (e) {
    const s = $(this)[0].dataset.toggleType,
      r = "text" === $(s).attr("type") ? "password" : "text";
    $(s).attr("type", r), $(this).toggleClass("fa-eye-slash");
  });
