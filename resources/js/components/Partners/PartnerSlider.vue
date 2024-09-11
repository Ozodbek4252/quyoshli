<template>
  <swiper
    ref="mySwiperBrand"
    class="swiper-container swiper-product"
    :options="swiperOptions"
  >
    <swiper-slide v-for="(partner, index) in partnersData" :key="index">
      <div class="partner">
        <div class="partner-logo">
          <a :href="'/brand/' + partner.slug">
            <img :src="'/' + partner.image" :alt="partner.name" />
          </a>
        </div>
      </div>
    </swiper-slide>


    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-next-product" slot="button-next"></div>
    <div class="swiper-button-prev swiper-button-prev-product" slot="button-prev"></div>

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-product" slot="pagination"></div>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
// import "swiper/swiper-bundle.css";
import 'swiper/css/swiper.css'

export default {
  props: ['partnersData'],

  components: {
    Swiper,
    SwiperSlide,
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
      },
      products: [],
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperBrand.$swiper;
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

.swiper-product {
  padding: 75px 0 20px;
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
