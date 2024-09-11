<template>
    <div class="balance-link">
        <a href="javascript:" data-target="#basket_modal" data-toggle="modal" @click="getCart"  class="basket">
            <i class="fas fa-shopping-basket"></i>
            <div class="basket-count">
                <input type="text" id="basket-count" readonly v-model="basket">
            </div>
        </a>

        <div class="modal fade basket-modal" id="basket_modal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">
                            <i class="fal fa-times"></i>
                        </button>

                        <h4>{{ $t('vue.cart_preview.basket_title') }}</h4>

                        <p class="mb-3 " v-if="products.length === 0">
                            {{ $t('app.no_product') }}
                        </p>

                        <form action="#" class="my-form my-form__auth">
                            <div class="product" v-for="(product, index) in products">
                                <div class="row align-items-center">

                                    <div class="col-lg-2">
                                        <div class="product-img">
                                            <img :src="'/' + product.product.product.poster_thumb" :alt="getName(product.product.product.name)">
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <h3 class="product-title">{{ getName(product.product.product.name) }}</h3>
                                        <div class="product-price_and_checkout mt-2">
                                            <div class="product-price-by-count mr-3">{{ $t('app.price') }} {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum_sht') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 mx-auto">
                                        <div class="product-count mb-md-0 mx-auto my-3 my-md-0">
                                            <span class="decrement" @click="CountMinus(product)"><i class="fal fa-minus"></i></span>
                                            <input type="text" v-model="product.count" min="0" class="h-auto" readonly>
                                            <span class="increment" @click="CountAdd(product)"><i class="fal fa-plus"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="product-buttons">
                                            <button type="button" class="product-to_delete" @click="removeProduct(product, index)">
                                                <i class="fal fa-times fa-2x"></i>
                                                <span>{{ $t('app.delete') }}</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr v-if="products.length > 0">
                            <div class="sum-of-products d-flex justify-content-end my-4" v-if="products.length > 0">
                                <h3>{{ $t('vue.cart.total_amount') }}: <span>{{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</span></h3>
                            </div>

                            <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center flex-md-row flex-column" v-if="products.length > 0">
                                    <a href="/cart"  class="my-btn my-btn__orange d-flex justift-content-center align-items-center text-white">{{ $t('vue.cart_preview.basket_checkout') }}</a>
                                    <div class="product-buttons mb-0 ml-md-3" v-if="on_credit">
                                        <a href="javascript:" v-if="!loginInfo" data-target="#login" data-toggle="modal" data-dismiss="modal" @click="CreditCookie" class="btn-links btn-links__one bg__green">
                                            {{ $t('vue.cart.credit') }}
                                        </a>

                                        <a href="/cart/oncredit/" v-if="loginInfo" class="btn-links btn-links__one bg__green">
                                            {{ $t('vue.cart.credit') }}
                                        </a>
                                    </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: {
            loginInfo: {}
        },

        data() {
            return {
                products: [],
                prices: 0,

                basket: 0,
                on_credit: 0
            }
        },

        created() {
            this.$eventBus.$on('cart-preview', this.getPreviews);
        },

        mounted() {
            this.getCount()
        },

        methods: {

            getPreviews() {
                this.getCart();
            },

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

            async getCount() {
                const { data } = await axios.get('/cart/basket/');

                if (data.status) {
                    this.basket = data.basket;
                }
            },

            async getCart() {
                const { data } = await axios.get('/cart/preview/');

                if (data.status) {
                    this.basket = data.products.length;
                    this.products = data.products;
                    this.prices = data.prices;
                    this.on_credit = data.on_credit
                }
            },

            CreditCookie() {
                this.$cookie.delete('product-credit');
                this.$cookie.set('cart-preview', 1);
            },

            async removeProduct(product, index) {
                const { data } = await axios.delete('/cart/delete/' + product.product_id);

                if (data.status) {
                    this.basket = data.count;
                    this.prices = data.prices;
                    this.products.splice(index, 1)
                }

            },
        }
    }
</script>

<style scoped>

</style>
