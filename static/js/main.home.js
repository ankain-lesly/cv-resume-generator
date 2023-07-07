// Demo
// const cars = $("#grid-cars").html();
// const parts = $("#grid-parts").html();
// const recent = $("#recent").html();
// for (let index = 1; index < 8; index++) {
//   $("#grid-cars").append(cars);
//   $("#grid-parts").append(parts);
//   $("#recent").append(recent);
// }
// NAV
$(".screen-overflow").on("click", function (e) {
  return handleNavMenu();
});
$(".close-nav-menu").on("click", function (e) {
  return handleNavMenu();
});
$(".nav-menu-btn").on("click", function (e) {
  return handleNavMenu();
});

function handleNavMenu() {
  $(".nav-menu").toggleClass("active");
}
// THEME
$(".theme-btn").on("click", function (e) {
  const currentTheme = document.documentElement.dataset.appTheme;

  if (currentTheme && currentTheme === "light") handleAppTheme("dark");
  else handleAppTheme("light");
});

function handleAppTheme(preset = null) {
  let theme = null;
  if (!preset) {
    theme = window.localStorage.getItem("app-theme");
  } else {
    window.localStorage.setItem("app-theme", preset);
    theme = preset;
  }

  return (document.documentElement.dataset.appTheme =
    theme === "light" ? "light" : "dark");
}
handleAppTheme();

// PRODUCT DI
function productGallery() {
  // GLOBAL VARIABLES
  const galleryImages = $(".gallery-image");
  let imagePosition = 0;
  /**
   * PREV NEXT
   */
  $(".display-prev").on("click", function (e) {
    displayPrevNext("left");
  });
  $(".display-next").on("click", function (e) {
    displayPrevNext("right");
  });
  /**
   * GALLERY IMAGES DISPLAY
   */
  $(".gallery-image").on("click", function (e) {
    if ($(".current-image").attr("src") === e.target.src) return;
    $(".current-image").attr("src", e.target.src);
    $(".current-image").attr("src", e.target.src);

    $(".image-group").removeClass("active");

    const $parent = $(this).closest(".image-group");
    if (!$parent.hasClass("active")) {
      $parent.addClass("active");
    }
  });
  /**
   * GALLERY WINDOW
   */
  $(".current-image").on("click", function (e) {
    const currentImageSrc = e.target.src;

    setImagePosition(currentImageSrc);

    $(".image-preview").fadeIn();
    indexGallery(null);

    $(".preview-right").on("click", function (e) {
      indexGallery("right");
    });
    $(".preview-left").on("click", function (e) {
      indexGallery("left");
    });

    $(".btn-close-preview").on("click", function () {
      $(".image-preview").fadeOut();
    });
  });
  /**
   * FUNCTIONS
   */
  // PREV AND NEXT
  function displayPrevNext(mode) {
    const currentImageSrc = $(".current-image").attr("src");
    setImagePosition(currentImageSrc);
    const image = indexGallery(mode, $(".current-image"));

    $(".image-group").removeClass("active");
    image.parentElement.classList.add("active");
  }
  // CHANGE MAIN IMAGE
  function indexGallery(direction, $imageHolder = $(".preview-image-default")) {
    if (direction == "left") imagePosition--;
    else if (direction == "right") imagePosition++;

    if (imagePosition < 0) imagePosition = galleryImages.length - 1;
    else if (imagePosition >= galleryImages.length) imagePosition = 0;

    $imageHolder.attr("src", galleryImages[imagePosition].src);
    return galleryImages[imagePosition];
  }
  // SET IMAGE POSITION
  function setImagePosition(currentImageSrc) {
    for (let image = 0; image < galleryImages.length; image++) {
      const imageSrc = galleryImages[image].src;
      if (currentImageSrc == imageSrc) {
        imagePosition = image;
      }
    }
  }
}
productGallery();

$("#grid-cars").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  nextArrow: $(".car-slick-left"),
  prevArrow: $(".car-slick-right"),
  responsive: [
    {
      breakpoint: 924,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 750,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
$("#grid-parts").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
  nextArrow: $(".part-slick-left"),
  prevArrow: $(".part-slick-right"),
  responsive: [
    {
      breakpoint: 924,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 750,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
