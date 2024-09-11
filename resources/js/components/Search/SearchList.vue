<template>
    <div>
        <div  v-if="products.length === 0">
            {{ $t('app.search_result', {text: searchText}) }}
        </div>

        <div class="row" v-if="products.length > 0">
            <div v-for="(product, index) in products" class="col-lg-12 col-md-6">
                <div class="product my-3">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <a :href="'/product/show/' + product.id + '-' + product.slug">
                                <div class="product-top">
                                    <div class="type" v-if="product.diffDate && product.isAvailable">NEW</div>
                                    <div class="discound" v-if="product.discountPrice > 0 && product.price_discount && product.isAvailable">
                                        {{ $t('vue.sale') }}
                                    </div>
                                    <div class="xit" v-if="product.leader_of_sales && product.isAvailable">ХИТ</div>
                                    <div class="no-product" v-if="!product.isAvailable">
                                        {{ $t('vue.not_available') }}
                                    </div>
                                </div>

                                <div class="product-img">
                                    <img :src="'/' + product.poster_thumb" :alt="getName(product.name)" :class="!product.isAvailable ? 'no-product-img' : ''" >
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <h3 class="product-title">
                                <a :href="'/product/show/' + product.id + '-' + product.slug">{{ getName(product.name) }}</a>
                            </h3>
<!--                            <div class="product-address">{{ $t('app.product.article_number') }}: {{ product.article_number }}</div>-->
                            <div class="product-price_and_checkout mt-2" v-if="product.discountPrice > 0">
                                <button class="my-btn my-btn__orange my-btn__orange--small">{{ $t('app.discount') }}</button>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-3">
                            <div class="product-price mt-3 mt-lg-0">
                                <div class="old-price mb-1 text-lg-right" v-if="product.price_discount">
                                    {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                                </div>
                                <div class="new-price text-lg-right">{{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</div>

                            </div>
                            <div class="product-buttons">
                                <div class="product-to_cart justify-content-lg-end">
                                    <button v-if="!product.isCart && product.isAvailable" :class="product.isCart ? 'product-to_basket is-active is-actived' : 'product-to_basket is-actived'" @click="AddToCart(product)">
                                        <i class="far fa-shopping-basket"></i>
                                        <span>{{ $t('app.to_cart') }}</span>

                                        <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">
                                        </div>
                                    </button>

                                    <button v-if="product.isCart && product.isAvailable" :class="product.isCart ? 'product-to_basket is-active is-actived' : 'product-to_basket is-actived'" data-target="#basket_modal" data-toggle="modal" @click="AddToCart(product)">
                                        <i class="far fa-shopping-basket"></i>
                                        <span>{{ $t('app.to_cart') }}</span>
                                    </button>

                                    <div class="d-flex">
                                        <button class="product-to_compare mr-3 ml-2">
                                            <i class="far fa-balance-scale"></i>
                                        </button>

                                        <button class="product-to_favorite" data-target="#login" data-toggle="modal" v-if="!loginInfo">
                                            <i class="fas fa-heart"></i>
                                        </button>

                                        <button :class="product.isFavorite ? 'product-to_favorite is-active' : 'product-to_favorite'" @click="Favorite(product)" v-if="loginInfo">
                                            <i class="fas fa-heart"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            searchData: {},
            loginInfo: {},
            searchText: {}
        },

        data () {
            return {
                products: this.searchData.data
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
            }


        }
    }
</script>

<style scoped>

</style>
