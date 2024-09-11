<template>
  <div>
    <section class="section-bonus">
      <div class="container">
        <div class="banner" v-if="bannersData.length === 1">
          <a :href="bannersData[0].link">
            <img :src="'/' + bannersData[0].image" />
          </a>
        </div>

        <div v-if="bannersData.length > 1">
          <swiper
            ref="mySwiperBonus"
            class="swiper-container swiper-banners"
            :options="swiperOptions"
          >
            <swiper-slide v-for="(banner, index) in bannersData" :key="index">
              <div class="banner">
                  <a :href="banner.link">
                    <img :src="'/' + banner.image" />
                  </a>
              </div>
            </swiper-slide>

            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-product" slot="button-next"></div>
            <div class="swiper-button-prev swiper-button-prev-product" slot="button-prev"></div>

            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-product" slot="pagination"></div>
          </swiper>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.css";
export default {
  props: ['bannersData'],
  components: {
    Swiper,
    SwiperSlide,
  },
  data() {
    return {
      swiperOptions: {
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
      },
      products: [],
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperBonus.$swiper;
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

.swiper-banners {
  padding: 75px 0 0px;
  margin-top: -50px;

  @include mq("tablet", max) {
    margin-left: -15px;
    margin-right: -15px;
    padding-bottom: 30px;
  }
}
</style>
