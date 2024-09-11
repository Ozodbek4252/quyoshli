<template>
    <div>
        <section class="section-checkout">
            <div class="container">
<!--                <h2 class="section-title">Оформление заказа</h2>-->

                <ul class="steps steps-one">
                    <li class="steps-item">
                        <a  href="#">
                            {{ $t('vue.cart.step_1')}}
                        </a>
                    </li>
                    <li class="steps-item">
                        <a href="/checkout">
                            {{ $t('vue.cart.step_2')}}
                        </a>
                    </li>
                    <li class="steps-item">
                        <a href="/checkout">
                            {{ $t('vue.cart.step_3')}}
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <section class="section-basket">
            <div class="container">
                <div class="d-flex align-items-md-center justify-content-between py-3 flex-md-row flex-column">
                    <h2 class="section-title">{{ $t('app.cart.title') }}</h2>
                </div>

                <p class="mb-3 " v-if="products.length === 0">
                    {{ $t('app.no_product') }}
                </p>

                <div class="row" v-if="products.length > 0">
                    <div class="col-lg-12 col-md-6">
                        <div class="product my-3">
                            <div class="row align-items-center" v-for="(product, index) in products">
                                <div class="col-lg-2">
                                    <div class="product-img">
                                        <img :src="'/' + product.product.product.poster_thumb" :alt="getName(product.product.product.name)">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <h3 class="product-title">
                                        {{ getName(product.product.product.name) }}
                                    </h3>
                                    <div class="product-address">{{ $t('app.product.article_number') }}: {{ product.product.product.article_number }}</div>
                                    <div class="product-price_and_checkout mt-2">
                                        <div class="product-price-by-count mr-3">{{ $t('app.price') }} {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum_sht') }}</div>
                                        <button class="my-btn my-btn__orange my-btn__orange--small" v-if="product.product.product.discountPrice > 0 && product.price_discount">{{ $t('app.discount') }}</button>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="product-count__title">
                                        {{ $t('vue.cart.count_by') }}
                                    </div>
                                    <div class="product-count">
                                        <span class="decrement" @click="CountMinus(product)"><i class="fal fa-minus"></i></span>
                                        <input type="text" v-model="product.count" min="0" readonly>
                                        <span class="increment" @click="CountAdd(product)"><i class="fal fa-plus"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="product-price">
                                        <div class="title-price">{{ $t('app.price') }}</div>
                                        <div class="old-price mb-1" v-if="product.price_discount"> {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</div>
                                        <div class="new-price">{{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="product-buttons">
                                        <button class="product-to_favorite__thin" data-target="#login" data-toggle="modal" v-if="!loginInfo">
                                            <i class="far fa-heart"></i>
                                            <span>{{ $t('app.favorites.in_favorite') }}</span>
                                        </button>

                                        <button class="product-to_favorite__thin" :class="product.product.product.isFavorite ? 'product-to_favorite__thin is-active' : 'product-to_favorite__thin'" @click="Favorite(product.product.product)" v-if="loginInfo">
                                            <i class="far fa-heart"></i>
                                            <span>{{ $t('app.favorites.in_favorite') }}</span>
                                        </button>

                                        <div class="v-line">|</div>
                                        <button class="product-to_delete" @click="removeProduct(product, index)">
                                            <i class="fal fa-times fa-2x"></i>
                                            <span>{{ $t('app.delete') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="basket__footer" v-if="products.length > 0">
                    <div class="basket__footer--left">
<!--                        <form action="index.html" class="my-form my-form__auth">-->
<!--                            <div class="d-flex align-items-xl-center flex-xl-row flex-column align-items-center align-items-md-start">-->
<!--                                <div class="my-form__group">-->
<!--                                    <input type="text" placeholder="Промокод" id="login_password" required>-->
<!--                                </div>-->
<!--                                <div class="">-->
<!--                                    <button type="sbumit" class="my-btn my-btn__gray ml-xl-3 mt-xl-0 mt-3">-->
<!--                                        {{ $t('vue.cart.get_discount') }}-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="mt-4 d-flex justify-content-md-start align-items-center align-items-md-start justify-content-center">-->
<!--                                <a href="javascript:void(0)" class="reset-password">-->
<!--                                    {{ $t('vue.cart.get_promocode') }}-->
<!--                                </a>-->
<!--                                <a href="javascript:void(0)" class="reset-password d-none">-->
<!--                                    {{ $t('vue.cart.another_promocode') }}-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </form>-->
                    </div>

                    <div class="basket__footer--right">
                        <div class="sum-of-products">
                            <h3>{{ $t('vue.cart.total_amount') }}: <span>{{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</span></h3>
                            <h5>{{ $t('vue.cart.saving') }}: <span>0 сум</span></h5>
                            <h2>{{ $t('vue.cart.total_cost') }}: <span>{{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</span></h2>
                        </div>
                    </div>
                </div>

                <div class="basket__footer" v-if="products.length > 0">
                    <a href="/" class="btn-links btn-links__one">{{ $t('vue.cart.continue_shopping') }}</a>
                    <div class="basket__footer--right mt-3 mt-md-0">
                        <button @click="removeAllProducts" class="btn-links btn-links__three mr-md-2 my-3 my-md-0">{{ $t('vue.cart.reset_cart') }}</button>
                        <a  href="/cart/oncredit/" v-if="loginInfo && creditInfo"  class="btn-links btn-links__one bg__green mr-md-2 my-3 my-md-0">
                            {{ $t('vue.cart.credit') }}
                        </a>

                        <a href="javascript:" v-if="!loginInfo && creditInfo" data-target="#login" data-toggle="modal" data-dismiss="modal" @click="CreditCookie" class="btn-links btn-links__one bg__green mr-md-2 my-3 my-md-0">
                            {{ $t('vue.cart.credit') }}
                        </a>

                        <a href="/checkout" class="btn-links btn-links__two">{{ $t('vue.cart.checkout_product') }}</a>
                    </div>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: {
            cartData: {},
            loginInfo: {},
            pricesData: {},
            creditInfo: {}
        },

        data() {
            return {
                products: this.cartData,
                prices: this.pricesData
            }
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

            async removeAllProducts() {
                const { data } = await axios.delete('/cart/remove/all');

                if (data.status) {
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                    this.prices = data.prices;
                    this.products = [];
                }
            },

            async CountMinus(product) {
                if (product.product.product.count >= product.count) {
                    if (product.count <= 1) {
                        product.count = 1;
                    } else {
                        product.count -= 1;
                    }
                } else {
                    product.count = product.product.product.count;
                }

                const fields = {
                    product_id: product.product_id,
                    count: product.count
                };

                const { data } = await axios.post('/cart/update', fields);

                if (data.status) {
                    product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                    this.prices = data.prices;
                    product.product.product.count = data.max_count;
                }
            },

            CreditCookie() {
                this.$cookie.delete('product-credit');
                this.$cookie.set('cart-preview', 1);
            },

            async CountAdd(product) {
                if (product.product.product.count > product.count){
                    product.count += 1;

                    const fields = {
                        product_id: product.product_id,
                        count: product.count
                    };

                    const { data } = await axios.post('/cart/update', fields);

                    if (data.status) {
                        product.isCart = true;
                        var basket = document.getElementById("basket-count");
                        basket.value = data.count;
                        this.prices = data.prices;
                        product.product.product.count = data.max_count;
                    }
                }
            },

            async Favorite(product) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                if (product.isFavorite === false) {
                    const { data } = await axios.get('/favorites/store/' + product.id);
                    product.isFavorite = true;
                    field.value = parseInt(count) + 1;
                } else {
                    const { data } = await axios.get('/favorites/delete/' + product.id);
                    product.isFavorite = false;
                    field.value = parseInt(count) - 1;
                }
            },

            async removeProduct(product, index) {
                const { data } = await axios.delete('/cart/delete/' + product.product_id);

                if (data.status) {
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                    this.prices = data.prices;
                    this.products.splice(index, 1)
                }

            },
        }

    }
</script>

<style scoped>

</style>
