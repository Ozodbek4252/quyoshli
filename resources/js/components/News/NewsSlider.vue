<template>
  <swiper ref="mySwiperNews" class="swiper-container swiper-product swiper-news" :options="swiperOptions">
    <swiper-slide v-for="post in postsData" v-bind:key="post.id">
      <News :post-data="post" />
    </swiper-slide>

    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-next-news" slot="button-next"></div>
    <div class="swiper-button-prev swiper-button-prev-news" slot="button-prev"></div>

    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-news" slot="pagination"></div>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import 'swiper/css/swiper.css'
import News from "./News";

export default {
  props: ['postsData'],

  components: {
    Swiper,
    SwiperSlide,
    News
  },
  
  data() {
    return {
      swiperOptions: {
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
      }
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperNews.$swiper;
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
