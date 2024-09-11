<template>
    <div>
        <section class="section-categories">
            <div class="container">
                <h2 class="section-title">{{ getName(brandData.name) }}</h2>

                <div class="aksiya">
                    <div class="alert alert-info w-100" v-if="products.length === 0">
                        <i class="fa fa-info-circle"></i> {{ $t('app.no_product') }}
                    </div>

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
            brandData: {}
        },

        components: {
            Product
        },

        data() {
            return {
                products: this.productsData.data
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

                // console.log(value);
                return value;

            },
        }
    }
</script>
