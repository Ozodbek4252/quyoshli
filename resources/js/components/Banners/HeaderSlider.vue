<template>
  <swiper ref="mySwiperHeader" class="swiper-container swiper-header" :options="swiperOptions">
    <swiper-slide v-for="(slider, index) in sliderData" :key="index">
        <a :href="slider.link" class="w-100 h-100 d-block">
            <div class="swiper-header__item" :style="{ 'background-image' : 'url(/' + slider.image +')' }"></div>
        </a>
    </swiper-slide>

    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-next-header" slot="button-next"></div>
    <div class="swiper-button-prev swiper-button-prev-header" slot="button-prev"></div>

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-header" slot="pagination"></div>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
// import "swiper/swiper-bundle.css";
import 'swiper/css/swiper.css'

export default {
  props: ['sliderData'],

  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      swiperOptions: {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
          nextEl: ".swiper-button-next-header",
          prevEl: ".swiper-button-prev-header",
        },
        pagination: {
          el: ".swiper-pagination-header",
          clickable: true,
        },
        loop: true,
        effect: "fade",
        speed: 1000,
        autoplay: {
          delay: 6000,
        },
      },
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperHeader.$swiper;
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
</style>
