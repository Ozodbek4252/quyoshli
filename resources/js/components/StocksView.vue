<template>
    <div>
        <section class="section-products" v-if="newsData.length > 0">
            <div class="container">
                <h2 class="section-title">{{ $t('vue.stocks.sales') }}</h2>
                <news-slider :posts-data="newsData"></news-slider>
            </div>
        </section>

        <section class="section-categories">
            <div class="container">
                <h2 class="section-title">{{ $t('vue.stocks.discount') }}</h2>

                <div class="aksiya">
                    <Product v-for="(product, index) in products" :key="index" :product="product" :login-info="loginInfo"/>
                </div>
            </div>
        </section>
    </div>

</template>

<script>
    import Product from './Products/Product.vue';

    export default {
        props: {
            productsData: {},
            loginInfo: {},
            newsData: {}
        },

        components: {
            Product
        },

        data() {
            return {
                products: this.productsData.data
            }
        }
    }
</script>
