// Import Token Component
// import { makeFetch } from "./token.js";

// console.log(makeFetch);

$("#login_form").on("submit", async function (e) {
  e.preventDefault();

  const formData = {};
  formData.username = e.target.username.value.trim();
  formData.password = e.target.password.value.trim();

  // makeAjax("POST", "http://localhost:8500/api/auth/login", formData);
  const { data, response } = await makeFetch(
    "POST",
    "http://localhost:8500/api/auth/login",
    formData
  );

  if (data.errors) return displayFormErrors(data.errors);
  if (!data.errors && data.message) return errorMessage(data.message);

  console.log(response);
  if (response.ok && response.status === 200) {
    alert("Login Successfull");
  }
});
// Remove error on keypress
$("#login_form input").on("keyup", function (e) {
  setTimeout(() => {
    $(this).closest(".form-group").removeClass("error");
  }, 500);
});
// Toggle Pass Visibility
$("[data-toggle-type]").on("click", function (e) {
  const key = $(this)[0].dataset.toggleType;
  const inputType = $(key).attr("type") === "text" ? "password" : "text";
  $(key).attr("type", inputType);
  $(this).toggleClass("fa-eye-slash");
});

async function makeFetch(method, url, data) {
  console.log("Request..");
  const return_data = {};

  const config = {
    method: method,
    headers: {
      // "Accept": "application/json",
      Accept: "*",
      // "Content-Type": "application/json",
      // Authorization: "Bearer xyz",
    },
  };

  if (method.toUpperCase() !== "GET") config.body = JSON.stringify(data);

  const res = await fetch(url, config).catch((err) => {
    console.log(err);
    // console.log(err.response.data);
  });
  return_data.data = await res.json();
  const response = { ok: res.ok, status: res.status };

  return_data.response = response;
  return return_data;
}

function displayFormErrors(errors) {
  $.each(errors, (key, array) => {
    const $parent = $(`#${key}`).closest(".form-group");
    $parent.addClass("error");
    $parent.find(".status-msg").text(array.errors[0]);
  });
}

function errorMessage(message) {
  const $parent = $(".form-group");
  $parent.addClass("error");

  $(".status-msg").text(message);
}
