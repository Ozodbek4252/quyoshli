<template>
    <div>
        <section v-if="!mobile" class="section-favorite d-md-block d-none">
            <div class="container">
                <h3 class="mb-3 section-title-small">{{ $t('app.favorites.title') }}</h3>
                <p class="mb-3 " v-if="favorites.length === 0">
                    {{ $t('app.no_product') }}
                </p>

                <div class="row" v-if="favorites.length > 0">
                    <div v-for="(product, index) in favorites" class="col-lg-12 col-md-6">
                        <div class="product my-3">
                            <div class="row align-items-center">
                                <div class="col-lg-2">
                                    <div class="product-img">
                                        <img :src="'/' + product.poster_thumb" :alt="getName(product.name)"  :class="!product.isAvailable ? 'no-product-img' : ''" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3 class="product-title">
                                        <a :href="'/product/show/' + product.id + '-' + product.slug">
                                            {{ getName(product.name) }}
                                        </a>
                                    </h3>
                                    <div class="product-address">{{ $t('app.product.article_number') }}: {{ product.article_number }}</div>
                                    <div class="product-price_and_checkout mt-2">
                                        <div class="product-price-by-count mr-3">{{ $t('app.price') }} {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum_sht') }}</div>
                                        <button class="my-btn my-btn__orange my-btn__orange--small" v-if="product.discountPrice > 0 && product.price_discount">{{ $t('app.discount') }}</button>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-2">
                                    <div class="product-price">
                                        <div class="title-price">{{ $t('app.price') }}</div>
                                        <div class="old-price mb-1" v-if="product.price_discount">
                                            {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                                        </div>
                                        <div class="new-price">{{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-xl-4">
                                    <div class="product-buttons">
                                        <div class="product-to_cart">
                                            <button v-if="!product.isCart" :class="product.isCart ? 'product-to_basket is-active is-actived' : 'product-to_basket is-actived'" @click="AddToCart(product)">
                                                <i class="far fa-shopping-basket"></i>
                                                <span>{{ $t('app.to_cart') }}</span>

                                                <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">

                                                </div>
                                            </button>

                                            <button v-if="product.isCart && product.isAvailable" :class="product.isCart ? 'product-to_basket is-active is-actived' : 'product-to_basket is-actived'" @click="AddToCart(product)">
                                                <i class="far fa-shopping-basket"></i>
                                                <span>{{ $t('app.to_cart') }}</span>


                                            </button>

<!--                                            <a href="balance.html" class="product-balance_link">-->
<!--                                                <button class="product-to_compares">-->
<!--                                                    <i class="fas fa-balance-scale"></i>-->
<!--                                                </button>-->
<!--                                                <span>{{ $t('app.compare') }}</span>-->
<!--                                            </a>-->
                                        </div>
                                        <div class="v-line">|</div>
                                        <button @click="removeProduct(product, index)" class="product-to_delete">
                                            <i class="fal fa-times fa-2x"></i>
                                            <span>{{ $t('app.delete') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Избранные товары -->
        <section v-if="mobile" class="section-products d-block d-md-none section-favorite">
            <div class="container">
                <h3 class="section-title-small">
                    {{ $t('app.favorites.title') }}
                </h3>

                <p class="mb-3 " v-if="favorites.length === 0">
                    {{ $t('app.no_product') }}
                </p>

                <div class="swiper-container swiper-product swiper-favorite">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(product, index) in favorites">
                            <div class="product">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="product-img">
                                            <img :src="'/' + product.poster_thumb" :alt="getName(product.name)"  :class="!product.isAvailable ? 'no-product-img' : ''" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <h3 class="product-title">{{ getName(product.name) }}</h3>
                                        <div class="product-address">{{ $t('app.product.article_number') }}: {{ product.article_number }}</div>
                                        <div class="product-price_and_checkout mt-2">
                                            <div class="product-price-by-count mr-3">{{ $t('app.price') }} {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum_sht') }}</div>
                                            <button class="my-btn my-btn__orange my-btn__orange--small">{{ $t('app.discount') }}</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-2">
                                        <div class="product-price">
                                            <div class="title-price">{{ $t('app.price') }}</div>
                                            <div class="old-price mb-1" v-if="product.price_discount">
                                                {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                                            </div>
                                            <div class="new-price">{{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-4">
                                        <div class="product-buttons">
                                            <div class="product-to_cart">

                                                <button v-if="product.isCart && product.isAvailable" :class="product.isCart ? 'product-to_basket is-active is-actived' : 'product-to_basket is-actived'" @click="AddToCart(product)">
                                                    <i class="far fa-shopping-basket"></i>
                                                    <span>{{ $t('app.to_cart') }}</span>


                                                </button>

<!--                                                <a href="balance.html" class="product-balance_link">-->
<!--                                                    <button class="product-to_compares">-->
<!--                                                        <i class="fas fa-balance-scale"></i>-->
<!--                                                    </button>-->
<!--                                                    <span>{{ $t('app.compare') }}</span>-->
<!--                                                </a>-->
                                            </div>
                                            <div class="v-line">|</div>
                                            <button @click="removeProduct(product, index)" class="product-to_delete">
                                                <i class="fal fa-times fa-2x"></i>
                                                <span>{{ $t('app.delete') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next swiper-button-next-product"></div>
                    <div class="swiper-button-prev swiper-button-prev-product"></div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination-product"></div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { isMobile } from 'mobile-device-detect';

    export default {
        props: {
            products: {},
            loginInfo: {}
        },

        data () {
            return {
                mobile: isMobile ? true : false,
                favorites: this.products.data
            }
        },

        mounted() {

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

            async removeProduct(product, index) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                const { data } = await axios.get('/favorites/delete/' + product.id);

                if (data.status) {
                    this.favorites.splice(index, 1);
                    field.value = parseInt(count) - 1;
                }

            },

            async AddToCart(product) {
                if (product.isCart) {
                    this.$eventBus.$emit('cart-preview');
                    return;
                }

                const fields = {
                    product_id: product.children.id,
                    count: 1
                };

                const { data } = await axios.post('/cart/store', fields);

                if (data.status) {
                    product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                }
            }

        }
    }
</script>
