(function ($) {
  "use strict";
  $(window).on("elementor/frontend/init", function () {
    // Features
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkufeatures.default",
      function ($scope) {
        let $feature_slider = $scope.find(".features-carousel");
        $feature_slider.owlCarousel({
          loop: false,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: true,
          autoplay: true,
          responsive: {
            0: {
              items: $feature_slider.data("sm-slide-show"),
            },
            600: {
              items: $feature_slider.data("md-slide-show"),
            },
            991: {
              items: $feature_slider.data("lg-slide-show"),
            },
            1024: {
              items: $feature_slider.data("lg-slide-show"),
            },
            1600: {
              items: $feature_slider.data("slide-show"),
            },
          },
        });
      }
    );

    // Counterup
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkucounterup.default",
      function ($scope) {
        $(".timer").countTo();
        $(".fun-fact").appear(
          function () {
            $(".timer").countTo();
          },
          {
            accY: -100,
          }
        );
      }
    );
    // Progressbar
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkuprogressbar.default",
      function ($scope) {
        var ProgressBar = (function () {
          "use strict";
          var t = function () {
            jQuery(document).ready(function () {
              jQuery(".progress").each(function () {
                jQuery(this).appear(function () {
                  jQuery(this).animate({ opacity: 1, left: "0px" }, 800);
                  var t = jQuery(this).find(".progress-bar").attr("data-width"),
                    r = jQuery(this).find(".progress-bar").attr("data-height");
                  jQuery(this)
                    .find(".progress-bar")
                    .animate(
                      { width: t + "%", height: r + "%" },
                      100,
                      "linear"
                    );
                });
              });
            });
          };
          return {
            init: function () {
              t();
            },
          };
        })();
        jQuery(document).ready(function () {
          ProgressBar.init();
        });
      }
    );

    // Overview
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkuoverview.default",
      function ($scope) {
        $(".overview-carousel").owlCarousel({
          loop: true,
          nav: false,
          margin: 30,
          dots: true,
          autoplay: true,
          items: 1,
          navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
          ],
          responsive: {
              2400: {
            //   stagePadding: 300,
              items: 1,
            },
            // 1200: {
            //   stagePadding: 300,
            //   items: 1,
            // },
          },
        });
        $(".screenshot-carousel").owlCarousel({
          loop: true,
          nav: false,
          margin: 30,
          dots: true,
          autoplay: false,
          items: 1,
          navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>",
          ],
          responsive: {
            0: {
              items: 1,
            },
            768: {
              items: 2,
              margin: 50,
            },

            1200: {
              stagePadding: 300,
              items: 2,
            },
          },
        });
      }
    );
    // Team
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkuteam.default",
      function ($scope) {
        let $team_slider = $scope.find(".team-carousel");
        $team_slider.owlCarousel({
          loop: false,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: true,
          autoplay: true,
          responsive: {
            0: {
              items: $team_slider.data("sm-slide-show"),
            },
            600: {
              items: $team_slider.data("md-slide-show"),
            },
            1024: {
              items: $team_slider.data("lg-slide-show"),
            },
            1600: {
              items: $team_slider.data("slide-show"),
            },
          },
        });
      }
    );
    // Blog
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkublogpost.default",
      function ($scope) {
        let $blog_slider = $scope.find(".blog-carousel");
        $blog_slider.owlCarousel({
          loop: false,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: true,
          autoplay: true,
          responsive: {
            0: {
              items: $blog_slider.data("sm-slide-show"),
            },
            600: {
              items: $blog_slider.data("md-slide-show"),
            },
            1024: {
              items: $blog_slider.data("lg-slide-show"),
            },
            1600: {
              items: $blog_slider.data("slide-show"),
            },
          },
        });
      }
    );
    // Pricing
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkupricing.default",
      function ($scope) {
        let $price_slider = $scope.find(".pricing-carousel");
        $price_slider.owlCarousel({
          loop: false,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: true,
          autoplay: true,
          responsive: {
            0: {
              items: $price_slider.data("sm-slide-show"),
            },
            600: {
              items: $price_slider.data("md-slide-show"),
            },
            1024: {
              items: $price_slider.data("lg-slide-show"),
            },
            1600: {
              items: $price_slider.data("slide-show"),
            },
          },
        });
      }
    );
    // Testimonials
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkutestimonials.default",
      function ($scope) {
        $(".testimonial-carousel").owlCarousel({
          loop: true,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: false,
          autoplay: true,
          responsive: {
            0: {
              items: 1,
            },
            600: {
              items: 2,
            },
            900: {
              items: 3,
            },
            1000: {
              items: 3,
            },
          },
        });
      }
    );
    // logo
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkugallery.default",
      function ($scope) {
        $(".partner-carousel").owlCarousel({
          loop: true,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: false,
          autoplay: true,
          responsive: {
            0: {
              items: 2,
            },
            600: {
              items: 3,
              margin: 50,
            },

            1000: {
              items: 5,
              margin: 80,
            },
          },
        });
        $(".partner-border-carousel").owlCarousel({
          loop: false,
          margin: 30,
          nav: false,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          dots: false,
          autoplay: true,
          responsive: {
            0: {
              items: 2,
              margin: 50,
            },
            800: {
              items: 3,
            },

            1000: {
              items: 4,
            },
          },
        });
      }
    );
    // grid and mesonary filtaring
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/appkuprojectgallery.default",
      function ($scope) {
        $("#portfolio-grid").imagesLoaded(function () {
          /* Filter menu */
          $(".mix-item-menu").on("click", "button", function () {
            var filterValue = $(this).attr("data-filter");
            $grid.isotope({
              filter: filterValue,
            });
          });

          /* filter menu active class  */
          $(".mix-item-menu button").on("click", function (event) {
            $(this).siblings(".active").removeClass("active");
            $(this).addClass("active");
            event.preventDefault();
          });

          /* Filter active */
          var $grid = $("#portfolio-grid").isotope({
            itemSelector: ".pf-item",
            percentPosition: true,
            masonry: {
              columnWidth: ".pf-item",
            },
          });

          /* Filter active */
          $(".blog-masonry").isotope({
            itemSelector: ".blog-item",
            percentPosition: true,
            masonry: {
              columnWidth: ".blog-item",
            },
          });
        });
      }
    );
  });
})(jQuery);
