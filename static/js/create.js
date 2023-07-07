$(".area-step .head").on("click", function (e) {
  $(".area-step .form-content").slideUp();
  setAccordion(".area-step", $(this).closest(".area-step"));

  let $content = $(this).siblings(".form-content");
  if ($content.hasClass("c-shown")) {
    $content.removeClass("c-shown").slideUp();
  } else {
    $content.addClass("c-shown").slideDown();
  }
});

function setAccordion(Elements, targetEl, className = "active") {
  $(Elements).removeClass(className);
  targetEl.addClass(className);
}
