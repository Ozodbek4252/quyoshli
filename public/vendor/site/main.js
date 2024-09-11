// Импортируем jQuery
// ../../../node_modules/jquery/dist/jquery.js

// Импортируем Popper
// ../../../node_modules/popper.js/dist/umd/popper.js
 
// Импортируем необходимые js-файлы Bootstrap 4
// ../../../node_modules/bootstrap/dist/js/bootstrap.js

// Импортируем другие js-файлы
// ../../../node_modules/swiper/js/swiper.min.js
// ../libs/jquery.maskedinput/jquery.maskedinput.min.js
// ../libs/pace.min.js
// $.mask.definitions['9'] = '';
// $.mask.definitions['n'] = '[0-9]';
// $(function(){
//   $("#phone-input").mask("+998 nn nnn nn nn");
//   $("#phone-input2").mask("+998 nn nnn nn nn");
//   $("#phone-input3").mask("XXXX XXXX XXnn nnnn");
//   $("#phone-input4").mask("nn/nn");
//   $("#phone-input5").mask("nnnn");
// });
//
// // When the user scrolls the page, execute myFunction

// (function () {
//     // Get the navbar
//     var myNavbar = document.getElementById("my_navbar");
//     var sticky = myNavbar.offsetTop;

//     // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
//     function myFunction() {
//         if (window.pageYOffset >= sticky + 100) {
//             myNavbar.classList.add("sticky");
//         } else {
//             myNavbar.classList.remove("sticky");
//         }
//     }

//     window.onload = function () {
//         myFunction();
//     };
//     window.onscroll = function () {
//         myFunction();
//     };
// })();

// var swiper = new Swiper('.swiper-container', {
//     // slidesPerView: 3,
//     // spaceBetween: 30,
//     loop: true,
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },
//     pagination: {
//         el: '.swiper-pagination',
//         clickable: true,
//     },
//     breakpoints: {
//         1024: {
//             slidesPerView: 5,
//             spaceBetween: 10,
//         },
//         576: {
//             slidesPerView: 2,
//             spaceBetween: 0,
//         },
//         414: {
//             slidesPerView: 2,
//             spaceBetween: 0,
//         },
//         375: {
//             slidesPerView: 2,
//             spaceBetween: 0,
//         }
//     },
//     autoplay: {
//         delay: 4000,
//     },
// });

// $(document).ready(function () {
//     var vid = $('.my_video').RTOP_VideoPlayer({
//         showTimer: true,
//         closeModalOnFinish: true,
//         allowReplay: true,
//         showTimer: true,
//         keyboardControls: true,
//         showControlsOnHover: true,
//         controlsHoverSensitivity: 500,
//         showCloseBtn: true,
//         allowReplay: true,
//         showFullScreen: true,
//     });
// });

//////////////////////////////////////// Swipers \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
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
var swiper_product_lider_sales = new Swiper(".swiper-product-lider_sales", {
  spaceBetween: 20,
  navigation: {
    nextEl: ".swiper-button-next-product",
    prevEl: ".swiper-button-prev-product",
  },
  pagination: {
    el: ".swiper-pagination-product",
    dynamicBullets: true,
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
  var forEach = function (t, o, r) {
    if ("[object Object]" === Object.prototype.toString.call(t))
      for (var c in t)
        Object.prototype.hasOwnProperty.call(t, c) && o.call(r, t[c], c, t);
    else for (var e = 0, l = t.length; l > e; e++) o.call(r, t[e], e, t);
  };

  var hamburgers = document.querySelectorAll(".hamburger");
  if (hamburgers.length > 0) {
    forEach(hamburgers, function (hamburger) {
      hamburger.addEventListener(
        "click",
        function () {
          this.classList.toggle("is-active");
        },
        false
      );
    });
  }
}
humbergers();
$(function () {
  $(".hamburger").on("click", function () {
    $(".my-navbar").toggleClass("my-navbar-active");
    $("body").toggleClass("menu-active");
    $(".navbar-toggler").toggleClass("navbar-toggler-active");
    $(".topbar-top").toggleClass("topbar-top-active");
    $(".search").toggleClass("search-active");
  });
  $(".nav-item-content__title i").on("click", function () {
    $(this).parent().siblings(".nav-item-content__toggle").slideToggle();
    $(this).toggleClass("fa-plus fa-minus");
  });
  $(".nav-item > i").on("click", function () {
    $(this).siblings(".nav-item-content").slideToggle();
    $(this).toggleClass("fa-chevron-down fa-chevron-up");
  });
});

//////////////////////////////////////// clickOutside \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
jQuery.fn.clickOutside = function (callback) {
  var $me = this;
  $(document).mouseup(function (e) {
    if (!$me.is(e.target) && $me.has(e.target).length === 0) {
      callback.apply($me);
    }
  });
};
$(".my-navbar, .navbar-toggler, .topbar-top, .search, .hamburger").clickOutside(
  function () {
    $(this).removeClass("my-navbar-active"); // or `$(this).hide()`, if you must
    $("body").removeClass("menu-active");
    $(".navbar-toggler").removeClass("navbar-toggler-active");
    $(".topbar-top").removeClass("topbar-top-active");
    $(".search").removeClass("search-active");
    $(".hamburger").removeClass("is-active");
  }
);

/////////////////////// Input Mask \\\\\\\\\\\\\\\\\\\\\\\\\\\
$.mask.definitions["9"] = "";
$.mask.definitions["n"] = "[0-9]";
$(function () {
  $("#login_phone").mask("+998 nn nnn nn nn");
  $("#reset_phone").mask("+998 nn nnn nn nn");
  $("#your_phone").mask("+998 nn nnn nn nn");
  // $("#phone-input3").mask("XXXX XXXX XXnn nnnn");
  // $("#phone-input4").mask("nn/nn");
  // $("#phone-input5").mask("nnnn");
});

/////////////////////// Product Cart \\\\\\\\\\\\\\\\\\\\\\\\\\\
$(document).ready(function () {
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
    // $(this).children().toggleClass("fas far");

    if ($(this).hasClass("is-active")) {
      favorite_count += 1;
    } else {
      favorite_count -= 1;
    }
    $(".favorite-count input").val(favorite_count);
  });

  // console.log(Number($(".favorite-count input").val()));
  // console.log(Number($(".basket-count input").val()));
  // console.log(Number($(".balance-count input").val()));
});

/////////////////////// Scroll to Top \\\\\\\\\\\\\\\\\\\\\\\\\\\
$(window).scroll(function () {
  if ($(this).scrollTop() >= 50) {
    // If page is scrolled more than 50px
    $("#return-to-top").fadeIn(200); // Fade in the arrow
  } else {
    $("#return-to-top").fadeOut(200); // Else fade out the arrow
  }
});

$("#return-to-top").click(function () {
  // When arrow is clicked
  $("body,html").animate(
    {
      scrollTop: 0, // Scroll to top of body
    },
    500
  );
});