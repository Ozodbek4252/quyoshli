//////////////////////////////////////// Swipers \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
var swiper_banners = new Swiper(".swiper-banners", {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    clickable: true,
    dynamicBullets: true,
  },
  speed: 1000,
  autoplay: {
    delay: 4500,
  },
});

var swiper_header = new Swiper(".swiper-header", {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next-header",
    prevEl: ".swiper-button-prev-header",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  effect: "fade",
  fadeEffect: {
    crossFade: true,
  },
  speed: 1000,
  autoplay: {
    delay: 6000,
  },
});

var swiper_specials = new Swiper(".swiper-specials", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    576: {
      slidesPerView: 1,
    },
    0: {
      slidesPerView: 1,
    },
  },
  autoplay: {
    delay: 4000,
  },
});
var swiper_product_lider_sales = new Swiper(".swiper-product-lider_sales", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 3,
    },
    576: {
      slidesPerView: 2,
    },
    0: {
      slidesPerView: 1.3,
    },
  },
  autoplay: {
    delay: 4000,
  },
});

var swiper_product_popular_products = new Swiper(
  ".swiper-product-popular_products",
  {
    spaceBetween: 20,
    navigation: {
      nextEl: ".swiper-button-next-product",
      prevEl: ".swiper-button-prev-product",
    },
    pagination: {
      el: ".swiper-pagination-product",
      dynamicBullets: true,
      clickable: true,
    },
    breakpoints: {
      1200: {
        slidesPerView: 5,
      },
      1024: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
      0: {
        slidesPerView: 1.3,
      },
    },
    autoplay: {
      delay: 3000,
    },
  }
);

var swiper_favorite = new Swiper(".swiper-favorite", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 3,
    },
    576: {
      slidesPerView: 2,
    },
    0: {
      slidesPerView: 1.2,
    },
  },
  autoplay: {
    delay: 3000,
  },
});

var swiper_product_new = new Swiper(".swiper-product-new", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 3,
    },
    576: {
      slidesPerView: 2,
    },
    0: {
      slidesPerView: 1.3,
    },
  },
  autoplay: {
    delay: 3500,
  },
});

var swiper_news = new Swiper(".swiper-news", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-news",
    prevEl: ".swiper-button-prev-news",
  },
  pagination: {
    el: ".swiper-pagination-news",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 3,
    },
    576: {
      slidesPerView: 2,
    },
    0: {
      slidesPerView: 1.3,
    },
  },
  autoplay: {
    delay: 3500,
  },
});

var swiper_partners = new Swiper(".swiper-partners", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 6,
    },
    1024: {
      slidesPerView: 4,
    },
    576: {
      slidesPerView: 3,
    },
    0: {
      slidesPerView: 2,
    },
  },
  autoplay: {
    delay: 5500,
  },
});

var swiper_partners = new Swiper(".swiper-category", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
    clickable: true,
  },
  breakpoints: {
    1200: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    576: {
      slidesPerView: 3,
    },
    0: {
      slidesPerView: 2,
    },
  },
  autoplay: {
    delay: 5500,
  },
});

//////////////////////////////////////// humbergers \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function humbergers() {
  var hamburgers = document.querySelector(".hamburger");
  hamburgers.addEventListener(
    "click",
    function () {
      this.classList.toggle("is-active");

      document.querySelector(".my-navbar").classList.toggle("my-navbar-active");
      document.querySelector("body").classList.toggle("menu-active");
      document
        .querySelector(".navbar-toggler")
        .classList.toggle("navbar-toggler-active");
      document
        .querySelector(".topbar-top")
        .classList.toggle("topbar-top-active");
      document.querySelector(".search").classList.toggle("search-active");
      document
        .querySelector(".topbar-bottom--bottom")
        .classList.toggle("topbar-bottom--bottom-active");
    },
    false
  );
}

$(function () {
  $(".nav-item-content__title i").on("click", function () {
    $(this).parent().siblings(".nav-item-content__toggle").slideToggle();
    $(this).toggleClass("fa-plus fa-minus");
  });
  $(".nav-item > i").on("click", function () {
    $(this).siblings(".nav-item-content").slideToggle();
    $(this).toggleClass("fa-chevron-down fa-chevron-up");
  });
});

humbergers();

/////////////////////// Input Mask \\\\\\\\\\\\\\\\\\\\\\\\\\\
$.mask.definitions["9"] = "";
$.mask.definitions["n"] = "[0-9]";
$(function () {
  $("#login_phone").mask("+998 nn nnn nn nn");
  $("#reset_phone").mask("+998 nn nnn nn nn");
  $("#your_phone").mask("+998 nn nnn nn nn");
  $("#feedback_phone").mask("+998 nn nnn nn nn");
  $("#feedback_phone2").mask("+998 nn nnn nn nn");
  $("#has_product").mask("+998 nn nnn nn nn");
});

$(function () {
  //////////////////////////////////////// clickOutside \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

  jQuery.fn.clickOutside = function (callback) {
    var $me = this;
    $(document).mouseup(function (e) {
      if (!$me.is(e.target) && $me.has(e.target).length === 0) {
        callback.apply($me);
      }
    });
  };

  $(
    ".my-navbar, .navbar-toggler, .topbar-top, .search, .hamburger, .topbar-bottom--bottom"
  ).clickOutside(function () {
    $(this).removeClass("my-navbar-active"); // or `$(this).hide()`, if you must
    $("body").removeClass("menu-active");
    $(".navbar-toggler").removeClass("navbar-toggler-active");
    $(".topbar-top").removeClass("topbar-top-active");
    $(".search").removeClass("search-active");
    $(".hamburger").removeClass("is-active");
    $(".topbar-bottom--bottom").removeClass("topbar-bottom--bottom-active");
  });

  /////////////////////// Product Cart \\\\\\\\\\\\\\\\\\\\\\\\\\\
  var favorite_count = Number($(".favorite-count input").val());
  var basket_count = Number($(".basket-count input").val());
  var balance_count = Number($(".balance-count input").val());

  $(".product-to_basket").on("click", function () {
    $(this).toggleClass("is-active");

    if ($(this).hasClass("is-active")) {
      basket_count += 1;
    } else {
      basket_count -= 1;
    }

    $(".basket-count input").val(basket_count);
  });

  $(".product-to_compare").on("click", function () {
    $(this).toggleClass("is-active");

    if ($(this).hasClass("is-active")) {
      balance_count += 1;
    } else {
      balance_count -= 1;
    }

    $(".balance-count input").val(balance_count);
  });

  $(".product-to_favorite").on("click", function () {
    $(this).toggleClass("is-active");

    if ($(this).hasClass("is-active")) {
      favorite_count += 1;
    } else {
      favorite_count -= 1;
    }
    $(".favorite-count input").val(favorite_count);
  });

  $(".product-to_favorite__thin").on("click", function () {
    $(this).toggleClass("is-active");

    if ($(this).hasClass("is-active")) {
      favorite_count += 1;
    } else {
      favorite_count -= 1;
    }
    $(".favorite-count input").val(favorite_count);
  });

  /////////////////////// Scroll to Top \\\\\\\\\\\\\\\\\\\\\\\\\\\
  $(window).on("scroll", function () {
    if ($(this).scrollTop() >= 50) {
      // If page is scrolled more than 50px
      $("#return-to-top").fadeIn(200); // Fade in the arrow
    } else {
      $("#return-to-top").fadeOut(200); // Else fade out the arrow
    }
  });

  $("#return-to-top").on("click", function () {
    // When arrow is clicked
    $("body,html").animate(
      {
        scrollTop: 0, // Scroll to top of body
      },
      500
    );
  });

  /////////////////////// Product added Alert \\\\\\\\\\\\\\\\\\\\\\\\\\\
  $(".product-to_basket").on("click", function () {
    var childs = $(this).children(".added-to-basket");
    childs.addClass("alert-is-active");

    $(this)
      .children(".alert-is-active")
      .fadeTo(3000, 750)
      .slideUp(750, function () {
        $(this).children(".alert-is-active").slideUp(750);
      });
  });
});
