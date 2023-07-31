import { handleAppTheme } from "./app_hooks.js";

// App Theme()
handleAppTheme();

$(document).on("scroll", function (e) {
  if ($(this).scrollTop() > 70) {
    $(".main-header").addClass("active");
  } else {
    $(".main-header").removeClass("active");
  }
});
