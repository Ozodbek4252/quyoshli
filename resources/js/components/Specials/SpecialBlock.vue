<template>
    <div>
        <div class="specials" v-if="!mobile">
            <a v-for="(offer, index) in offers" :key="index" :href="offer.link" class="special"  :style="{ 'background-image': 'url(/' + offer.image + ')' }">
                <div class="special-content">
                    <h3 class="special-title">{{ getName(offer.name) }}</h3>
                    <p class="special-price">{{ getName(offer.description) }}</p>
                    <div class="my-btn my-btn__orange">
                        <span>{{ $t('vue.special.more') }}</span>
                        <i class="fal fa-chevron-right ml-2"></i>
                    </div>
                </div>
            </a>
        </div>

        <swiper
                ref="mySwiperSpicial"
                class="swiper-container swiper-product swiper-specials"
                :options="swiperOptions"
                v-if="mobile"
        >
            <swiper-slide v-for="(offer, index) in offers" :key="index">
                <div class="specials">
                    <a :href="offer.link" class="special" :style="{ 'background-image': 'url(/' + offer.image + ')' }">
                        <div class="special-content">
                            <h3 class="special-title">{{ getName(offer.name) }}</h3>
                            <p class="special-price">{{ getName(offer.description) }}</p>

                            <div class="my-btn my-btn__orange">
                                <span>{{ $t('vue.special.more') }}</span>
                            </div>
                        </div>
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
</template>

<script>
    import { Swiper, SwiperSlide } from "vue-awesome-swiper";
    import 'swiper/css/swiper.css'
    import { isMobileOnly } from "mobile-device-detect";


    export default {
        props: {
            offersData: {}
        },

        components: {
            Swiper,
            SwiperSlide,
            isMobileOnly
        },

        data() {
            return {
                mobile: isMobileOnly ? true : false,

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
                },
                offers: this.offersData,
            };
        },

        computed: {
            swiper() {
                return this.$refs.mySwiperSpicial.$swiper;
            },
        },

        methods: {
            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (lang) {
                    switch(lang){
                        case "ru":
                            value = name.ru;
                            break;
                        case "uz":
                            value = name.uz;
                            break;
                    }
                } else {
                    value = name.ru;
                }

                return value;
            },
        }
    }
</script>

<style lang="scss">

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
            "desktop-large": 2500px
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

    .swiper-specials {
        padding-left: 0;
        padding-right: 0;
        margin-bottom: 0;
        margin-top: 50px;

        @include mq("tablet", max) {
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 0px;
            padding-top: 0px;
            padding-bottom: 30px;
            margin-top: 0;
        }
        .specials {
            .special {
                width: 100%;

                @include mq("tablet", max) {
                    margin-bottom: 0;
                }
            }
        }
    }
</style>
