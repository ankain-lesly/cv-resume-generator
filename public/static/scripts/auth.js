// User Authentication - JS API Endpoints
import { useFetch, useToken, useStorage } from "./token.js";
// api root
const APP_ROOT = "http://localhost:8500";
let isLoading = false;
// Handle Signup
$("#signup_form").on("submit", async (e) => {
  e.preventDefault();

  const formData = {};
  formData.username = e.target.username.value.trim();
  formData.email = e.target.email.value.trim();
  formData.phone = e.target.phone.value.trim();
  formData.password = e.target.password.value.trim();
  formData.confirm_password = e.target.confirm_password.value.trim();
  formData.keep_alive = e.target.keep_alive.checked;

  submitFormData(formData, "/auth/signup");
});
// Handle Login
$("#login_form").on("submit", async (e) => {
  e.preventDefault();

  const formData = {};
  formData.username = e.target.username.value.trim();
  formData.password = e.target.password.value.trim();
  formData.keep_alive = e.target.keep_alive.checked;

  submitFormData(formData, "/auth/login");
});
const submitFormData = async (formData, endpoint, redirect_route = "/") => {
  if (isLoading) return;
  setBtnLoading();
  const res = await useFetch("POST", APP_ROOT + endpoint, formData);

  if (!res) {
    const message = "Error making requests, please try again";
    return errorMessage(message);
  }
  const { data, response } = res;

  if (data.errors) return displayFormErrors(data.errors);
  if (!data.errors && data.message) return errorMessage(data.message);

  if (response.ok && response.status === 200) {
    // resolve_form() && Redirect()
    useToken(data._sess_token);
    useStorage("_reff", data._reff ?? false);

    window.location = redirect_route;
  }
};
// Remove Form Errors on key
$("form input").on("keyup", function (e) {
  setTimeout(() => {
    $(this).closest(".form-group").removeClass("error");
  }, 500);
});
$("form input").on("blur", function (e) {
  setTimeout(() => {
    $(this).closest(".form-group").removeClass("error");
  }, 500);
});

// Toggle Visibility
$("[data-toggle-type]").on("click", function (e) {
  const key = $(this)[0].dataset.toggleType;
  const inputType = $(key).attr("type") === "text" ? "password" : "text";
  $(key).attr("type", inputType);
  $(this).toggleClass("fa-eye-slash");
});

// Display Form Errors
function displayFormErrors(errors) {
  $.each(errors, (key, array) => {
    const $parent = $(`#${key}`).closest(".form-group");
    $parent.addClass("error");
    $parent.find(".status-msg").text(array.errors[0]);
  });
  $(".form-message").removeClass("error");
  setBtnDone();
}

// Display Error Messages
function errorMessage(message) {
  const $msgBox = $(".form-message");
  $msgBox.addClass("error").text(message);
  $(".form-message")[0].scrollIntoView();
  setBtnDone();
}

function setBtnLoading() {
  isLoading = true;
  $(".form_btn").addClass("process");
}
function setBtnDone() {
  isLoading = false;
  $(".form_btn").removeClass("process");
}
