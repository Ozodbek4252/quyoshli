<template>
  <div>
    <!-- Category -->
    <section class="section-category">
      <div class="container">
        <div class="category" v-if="!mobile">
          <a :href="settingData.links.one" class="category-item">
              <div class="category-item__logo">
                <img src="/vendor/site/img/category_img1.png" alt />
              </div>
              <h3 class="category-item__title">{{ $t('vue.feature.feature_title_1') }}</h3>
          </a>
          <a :href="settingData.links.two" class="category-item">
            <div class="category-item__logo">
              <img src="/vendor/site/img/category_img2.png" alt />
            </div>
            <h3 class="category-item__title">{{ $t('vue.feature.feature_title_2') }}</h3>
          </a>
          <a :href="settingData.links.three" class="category-item">
            <div class="category-item__logo">
              <img src="/vendor/site/img/category_img3.png" alt />
            </div>
            <h3 class="category-item__title">{{ $t('vue.feature.feature_title_3') }}</h3>
          </a>
          <a :href="settingData.links.four" class="category-item">
            <div class="category-item__logo">
              <img src="/vendor/site/img/category_img4.png" alt />
            </div>
            <h3 class="category-item__title">{{ $t('vue.feature.feature_title_4') }}</h3>
          </a>
          <a :href="settingData.links.five" class="category-item">
            <div class="category-item__logo">
              <img src="/vendor/site/img/category_img5.png" alt />
            </div>
            <h3 class="category-item__title">{{ $t('vue.feature.feature_title_5') }}</h3>
          </a>
        </div>

        <swiper
          ref="mySwiperCategory"
          class="swiper-container swiper-product swiper-category"
          :options="swiperOptions"
          v-if="mobile"
        >
          <swiper-slide>
            <a :href="settingData.links.one" class="category-item">
                <div class="category-item__logo">
                  <img src="/vendor/site/img/category_img1.png" alt />
                </div>
                <h3 class="category-item__title">{{ $t('vue.feature.feature_title_1') }}</h3>
            </a>
          </swiper-slide>
          <swiper-slide>
            <a :href="settingData.links.two" class="category-item">
              <div class="category-item__logo">
                <img src="/vendor/site/img/category_img2.png" alt />
              </div>
              <h3 class="category-item__title">{{ $t('vue.feature.feature_title_2') }}</h3>
            </a>
          </swiper-slide>
          <swiper-slide>
            <a :href="settingData.links.three" class="category-item">
              <div class="category-item__logo">
                <img src="/vendor/site/img/category_img3.png" alt />
              </div>
              <h3 class="category-item__title">{{ $t('vue.feature.feature_title_3') }}</h3>
            </a>
          </swiper-slide>
          <swiper-slide>
            <a :href="settingData.links.four" class="category-item">
              <div class="category-item__logo">
                <img src="/vendor/site/img/category_img4.png" alt />
              </div>
              <h3 class="category-item__title">{{ $t('vue.feature.feature_title_4') }}</h3>
            </a>
          </swiper-slide>
          <swiper-slide>
            <a :href="settingData.links.five" class="category-item">
              <div class="category-item__logo">
                <img src="/vendor/site/img/category_img5.png" alt />
              </div>
              <h3 class="category-item__title">{{ $t('vue.feature.feature_title_5') }}</h3>
            </a>
          </swiper-slide>

          <!-- Add Arrows -->
          <div class="swiper-button-next swiper-button-next-product" slot="button-next"></div>
          <div class="swiper-button-prev swiper-button-prev-product" slot="button-prev"></div>

          <!-- Add Pagination -->
          <div class="swiper-pagination swiper-pagination-product" slot="pagination"></div>
        </swiper>
      </div>
    </section>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
// import "swiper/swiper-bundle.css";
import "swiper/css/swiper.css";
import { isMobileOnly } from "mobile-device-detect";
export default {
  props: {
    settingData: {}
  },

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
      mobile: isMobileOnly ? true : false,
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiperCategory.$swiper;
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
