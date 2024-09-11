<template>
  <swiper
    ref="mySwiper"
    class="swiper-container swiper-product swiper-product-lider_sales"
    :options="swiperOptions"
  >
    <swiper-slide v-for="(product, index) in products" :key="index">
      <Product :product="product" :login-info="loginInfo"/>
    </swiper-slide>

    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-next-product" slot="button-next"></div>
    <div class="swiper-button-prev swiper-button-prev-product" slot="button-prev"></div>

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-product" slot="pagination"></div>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
//import "swiper/swiper-bundle.css";
import Product from './Product.vue';
import 'swiper/css/swiper.css'

export default {
  props: {
    productsData: {},
    loginInfo: {}
  },
  components: {
    Swiper,
    SwiperSlide,
    Product
  },
  data() {
    return {
      swiperOptions: {
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
      },
      products: this.productsData,
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiper.$swiper;
    },
  },
};
</script>

<style scoped lang="scss">
$breakpoints: (
  "phone-smallest": 251px,
  "phone-small": 321px,
  "phone": 400px,
  "phone-wide": 480px,
  "phablet": 560px,
  "tablet-small": 640px,
  "tablet": 768px,
  "tablet-wide": 1024px,
  "desktop": 1248px,
  "desktop-wide": 1440px,
  "desktop-large": 2500px,
);

@mixin mq($width, $type: min) {
  @if map_has_key($breakpoints, $width) {
    $width: map_get($breakpoints, $width);

    @if $type==max {
      $width: $width - 1px;
    }

    @media only screen and (#{$type}-width: $width) {
      @content;
    }
  }
}
// Transition
%tr03 {
  transition: all 0.3s ease-out;
}

%tr02 {
  transition: all 0.2s ease-out;
}
$my-orange: rgb(255, 98, 26);
$my-dark-gray: #5b5b5b;
$my-blue-dark: #0a0d21;

// Vertical or Horizontal position
%v-c {
  position: absolute;
  top: 50%;
  -ms-transform: translateY(-50%);
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}

%h-c {
  position: absolute;
  left: 50%;
  -ms-transform: translateX(-50%);
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
}
%c-c {
  position: absolute;
  left: 50%;
  top: 50%;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.swiper-product {
  padding: 75px 0 50px;
  margin-top: -50px;
  padding-left: 10px;
  padding-right: 10px;

  @include mq("tablet", max) {
    margin-left: -15px;
    margin-right: -15px;
    padding-bottom: 30px;
  }
}

</style>
