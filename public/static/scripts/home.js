/**
 * @author  Ankain Lesly <leeleslyank@gmail.com>
 * @package  Resume Generator Application
 * >>>
 * github https://github.com/ankain-lesly
 * portfolio https://lesly-chuo.letech-cg.com
 */

import { handleAppTheme } from "./app_hooks.js";
handleAppTheme(),
  $(document).on("scroll", function (e) {
    $(this).scrollTop() > 70
      ? $(".main-header").addClass("active")
      : $(".main-header").removeClass("active");
  }),
  $(".nav-menu-btn").on("click", () => $(".nav-menu").addClass("active")),
  $(".screen-overflow").on("click", () => $(".nav-menu").removeClass("active"));
