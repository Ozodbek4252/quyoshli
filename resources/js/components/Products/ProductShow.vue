<template>
    <section class="section-product-item">
        <div class="container">
            <div class="row" itemtype="http://schema.org/Product" itemscope>
                <meta itemprop="mpn" :content="product.id" />
                <meta itemprop="name" :content="getName(product.name)" />
                <link itemprop="image" :href="product.children.screen.path_thumb" />
                <meta itemprop="description" :content="getName(product.short_body)" />

                <div itemprop="offers" itemtype="http://schema.org/Offer" itemscope>
                    <link itemprop="url" :href="'https://alistore.uz/product/show/' + product.id + '-' + product.slug  " />
                    <meta itemprop="availability" content="https://schema.org/InStock" />
                    <meta itemprop="priceCurrency" content="UZS" />
                    <meta itemprop="itemCondition" content="https://schema.org/UsedCondition" />
                    <meta itemprop="price" :content="product.price_discount ? product.price_discount : product.price" />
                </div>

                <div class="col-lg-4">
                    <div class="product-cart">
                        <div class="product-top">
                            <div class="type" v-if="product.diffDate && product.isAvailable">NEW</div>
                            <div class="discound" v-if="product.discountPrice > 0 && product.price_discount && product.isAvailable">
                                {{ $t('vue.sale') }}
                            </div>
                            <div class="xit" v-if="product.leader_of_sales && product.isAvailable">{{ $t('vue.xit') }}</div>
                            <div class="discound"
                                 v-if="product.discountPrice > 0 && product.price_discount && product.isAvailable">-{{
                                product.discountPrice }}%
                            </div>
                            <div class="xit" v-if="product.leader_of_sales && product.isAvailable">{{ $t('vue.xit') }}
                            </div>
                            <div class="no-product" v-if="!product.isAvailable">{{ $t('vue.not_available') }}</div>
                        </div>

                        <div class="product-buttons">
                            <button class="product-to_favorite" data-target="#login" data-toggle="modal"
                                    v-if="!loginInfo">
                                <i class="fas fa-heart"></i>
                            </button>

                            <button
                                :class="product.isFavorite ? 'product-to_favorite is-active' : 'product-to_favorite'"
                                @click="Favorite(product)" v-if="loginInfo">
                                <i class="fas fa-heart"></i>
                            </button>

                            <!--                            <button class="product-to_compare mt-2">-->
                            <!--                                <i class="far fa-balance-scale"></i>-->
                            <!--                            </button>-->
                        </div>
                    </div>
                    <div class="slider slider-big" id="aniimated-thumbnial">
                        <div class="slider__content" v-for="(screen, index) in product.childrens[0].screens">
                            <div class="slider__img">
                                <div class="item" :data-src="'/' + screen.path">
                                    <img :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider slider-small py-3 px-2" id="aniimated-thumbnials">
                        <div class="slider__img" v-for="(screen, index) in product.childrens[0].screens">
                            <div class="item1" :data-src="'/' + screen.path">
                                <img class="" :src="'/' + screen.path_thumb" :alt="getName(product.name)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 view_box">
                    <div class="product pt-lg-3 pt-0">
                        <div class="share d-flex align-items-md-center mt-lg-4 mt-2 flex-column flex-md-row mb-3">
                            <p class="mb-md-0 mr-md-3 mt-1">{{ $t('vue.news.news_share') }}:</p>
                            <div class="socials">
                                <ShareNetwork :url="url" network="facebook" :title="getName(product.name)">
                                    <i class="fab fa-facebook-f"></i>
                                </ShareNetwork>

                                <ShareNetwork :url="url" network="telegram" :title="getName(product.name)">
                                    <i class="fab fa-telegram-plane"></i>
                                </ShareNetwork>

                                <ShareNetwork :url="url" network="vk" :title="getName(product.name)">
                                    <i class="fab fa-vk"></i>
                                </ShareNetwork>

                                <ShareNetwork :url="url" network="odnoklassniki" :title="getName(product.name)">
                                    <i class="fab fa-odnoklassniki"></i>
                                </ShareNetwork>
                            </div>
                        </div>

                        <h1 class="product-title">
                            {{ getName(product.name) }}
                        </h1>

                        <div class="product-price mb-0">
                            <div class="new-price">
                                {{ product.price_discount ? product.price_discount : product.price | number('0,0', {
                                thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                            </div>

                            <div class="old-price mt-1" v-if="product.price_discount">
                                {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
                            </div>

                        </div>

                        <div class="product-price align-items-md-center h-100" v-if="settingData.on_credit && product.category.credit && product.price > 500000 && product.price > 500000">
                            <h3 class="product-title mr-2 mt-3 mt-md-0 mb-0">{{ $t('vue.product.in_credit') }}</h3>
                            <div class="new-price">{{ product.onCredit | number('0,0', { thousandsSeparator: ' ' }) }}
                                {{ $t('vue.product.sum_m') }}
                            </div>
                        </div>

                        <p class="product-subtitle" v-html="getName(product.short_body)">

                        </p>

                        <div class="product-color" v-if="colors">
                            <p>{{ $t('vue.cart.product_color_title') }}:</p>
                            <div class="colors">
                                <ul>
                                    <li v-for="(color, index) in product.childrens" :key="index">
                                        <label v-if="color.color">
                                            <input type="radio" name="color" v-model="color_id" value="black"
                                                   :checked="index === 0">
                                            <span class="swatch"
                                                  :style="{ 'background-color': '#' + color.color.color, 'border-color':  '#' + color.color.color }"></span>
                                        </label>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="d-flex align-items-md-center flex-wrap flex-md-row" v-if="product.isAvailable">
                            <div class="product-count">
                                <span class="decrement" @click="CountMinus"><i class="fal fa-minus"></i></span>
                                <input type="text" value="1" v-model="count" min="0" readonly>
                                <span class="increment" @click="CountAdd"><i class="fal fa-plus"></i></span>
                            </div>

                            <div class="product-buttons">

                                <button v-if="!product.isCart"
                                        :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'"
                                        @click="AddToCart">
                                    <i class="far fa-shopping-basket"></i>
                                    <span class="d-inline-block">{{ $t('vue.cart.product_to_basket_title') }}</span>

                                    <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">

                                    </div>
                                </button>

                                <button v-if="product.isCart"
                                        :class="product.isCart ? 'product-to_basket is-actived is-active' : 'product-to_basket is-actived'"
                                        @click="AddToCart" data-target="#basket_modal" data-toggle="modal">
                                    <i class="far fa-shopping-basket"></i>
                                    <span class="d-inline-block">{{ $t('vue.cart.product_to_basket_title') }}</span>
                                </button>

                                <div v-if="product.category.credit && product.price > 500000">
                                    <a href="javasciprt:" v-if="!loginInfo && settingData.on_credit && product.price > 500000"
                                       data-target="#login" data-toggle="modal" @click="CreditCookie"
                                       class="btn-links btn-links__one">{{ $t('vue.cart.buy_in_credit') }}</a>
                                    <a href="javasciprt:" data-target="#installment" data-toggle="modal"
                                       v-if="loginInfo && settingData.on_credit && product.price > 500000" class="btn-links btn-links__one">{{
                                        $t('vue.cart.buy_in_credit') }}</a>
                                </div>

                                <a href="javascript:0" class="btn-links btn-links__one bg__green"
                                   data-target="#buy-by-one-click" data-toggle="modal">{{ $t('vue.cart.buy_in_click')
                                    }}</a>
                            </div>
                        </div>

                        <div class="now-no-product" v-if="!product.isAvailable">
                            <p>{{ $t('vue.not_available') }}</p>
                            <button data-target="#alert-when-has-product" data-toggle="modal">{{ $t('vue.notification')
                                }}
                            </button>
                        </div>

                        <div class="payments d-flex align-items-center my-4 flex-wrap">
                            <p class="mr-3 mb-0">{{ $t('vue.cart.payment_title') }}: </p>
                            <div class="d-flex align-items-baseline flex-wrap">
                                <div class="payments-item mr-md-4 m-3 ml-md-0 my-md-0">
                                    <img class="img-fluid" src="/vendor/site/img/apelsin.png" alt="Apelsin">
                                </div>

                                <div class="payments-item mr-md-4 m-3 ml-md-0 my-md-0">
                                    <img class="img-fluid" src="/vendor/site/img/click.png" alt="Click">
                                </div>

                                <div class="payments-item mr-md-4 m-3 ml-md-0 my-md-0">
                                    <img class="img-fluid" src="/vendor/site/img/payme.png" alt="Payme">
                                </div>
                                <div class="payments-item mr-md-4 m-3 ml-md-0 my-md-0">
                                    <img class="img-fluid" src="/vendor/site/img/naqt.png" alt="Naqt">
                                    <span style="transform: translateY(2px);" class="ml-1 d-inline-block">{{ $t('vue.checkout.delivery_in_cash') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info mb-2" v-if="settingData.delivery">
                            <p><b>{{ $t('vue.checkout.delivery_title') }}:</b>
                                {{ getName(settingData.other.delivery) }}
                            </p>
                        </div>
                        <div class="product-info mb-2" v-if="settingData.pickup">
                            <p><b>{{ $t('vue.checkout.delivery_pickup') }}:</b> {{ getName(settingData.other.pickup) }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="all_tabs py-4">
                <ul class="tabs">
                    <li :class="product.characteristics.length > 0 ? 'active' : ''"
                        v-if="product.characteristics.length > 0" rel="tab1">{{ $t('vue.cart.characteristic') }}
                    </li>
                    <li :class="product.characteristics.length === 0 ? 'active' : ''" rel="tab2">{{
                        $t('vue.cart.description') }}
                    </li>
                    <li rel="tab3">{{ $t('vue.cart.reviews') }} <span class="badge badge-secondary">{{ product.comments.length }}</span>
                    </li>
                    <!--                    <li rel="tab3">{{ $t('vue.cart.reviews') }} <sup><span class="badge badge-secondary" style="font-size: 100%;">5</span></sup></li>-->

                </ul>
                <div class="tab_container">
                    <h3 class="d_active tab_drawer_heading" rel="tab1" v-if="product.characteristics.length > 0 ">{{
                        $t('vue.cart.characteristic') }}</h3>
                    <div id="tab1" class="tab_content" v-if="product.characteristics.length > 0 ">
                        <h4 class="title title--lg p-b-15 view__title">{{ $t('vue.cart.all_characteristic') }}</h4>
                        <table class="view__table table table-bordered table-striped">
                            <tbody>
                            <tr v-for="(char, index) in product.characteristics" :key="index"
                                v-if="char.pivot.value != 'null'">
                                <td class="view__td-1">
                                    <div class="view__td-dots">
                                            <span class="view__td-info">
                                                {{ getName(char.name) }}
                                            </span>
                                    </div>
                                </td>
                                <td class="view__td-2" v-if="char.type === 'checkbox'">
                                        <span v-if="char.pivot.value === 'true'">
                                            {{ $t('app.exist') }}
                                        </span>
                                    <span v-if="char.pivot.value === 'false'">
                                            {{ $t('app.no') }}
                                        </span>
                                </td>

                                <td class="view__td-2" v-else>
                                    {{ char.pivot.value }}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- #tab1 -->
                    <h3 class="tab_drawer_heading" rel="tab2">{{ $t('vue.cart.description') }}</h3>
                    <div id="tab2" class="tab_content" v-html="getName(product.body)">

                    </div>
                    <!-- #tab2 -->
                    <h3 class="tab_drawer_heading" rel="tab3">{{ $t('vue.cart.reviews') }} <span
                        class="badge badge-secondary">{{ product.comments.length }}</span></h3>
                    <div id="tab3" class="tab_content">
                        <div class="container">
                            <div class="row">
                                <div class="message-wrap">
                                    <div id="review" v-if="product.comments.length === 0">
                                        <p>{{ $t('vue.cart.no_reviews') }}</p>
                                    </div>

                                    <div class="msg-wrap" v-if="product.comments.length > 0">
                                        <comment-list v-for="(comment, index) in product.comments"
                                                      :comment-data="comment" :key="index"></comment-list>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div v-if="!loginInfo">
                            <h5>{{ $t('vue.cart.only_comment_after_auth') }}</h5>

                            <button type="button" class="my-btn my-btn__orange mt-3" data-target="#login"
                                    data-toggle="modal">
                                {{ $t('vue.login.auth_title') }}
                            </button>
                        </div>

                        <div class="alert alert-success" v-if="alertComment">
                            <i class="fas fa-info-circle"></i> {{ $t('vue.cart.success_comment') }}
                        </div>

                        <form class="form-horizontal" @submit.prevent="StoreComment" id="form-review" v-if="loginInfo">

                            <h2>{{ $t('vue.cart.write_review') }}</h2>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label" for="input-name">{{ $t('vue.cart.your_name')
                                        }}:</label>
                                    <input type="text" name="name" v-model="comment.first_name" value="" id="input-name"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label" for="input-review">{{ $t('vue.cart.your_review')
                                        }}:</label>
                                    <textarea name="text" v-model="comment.body" rows="5" id="input-review"
                                              class="form-control"></textarea>
                                    <!--                                    <div class="help-block">-->
                                    <!--                                        <span style="color: #FF0000;">{{ $t('vue.cart.only_text') }}</span>-->
                                    <!--                                    </div>-->
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label">{{ $t('vue.cart.product_rating') }}</label>
                                    &nbsp;&nbsp;&nbsp;{{ $t('vue.cart.bad') }}&nbsp;
                                    <input type="radio" name="rating" v-model="comment.star" value="1">
                                    &nbsp;
                                    <input type="radio" name="rating" v-model="comment.star" value="2">
                                    &nbsp;
                                    <input type="radio" name="rating" v-model="comment.star" value="3">
                                    &nbsp;
                                    <input type="radio" name="rating" v-model="comment.star" value="4">
                                    &nbsp;
                                    <input type="radio" name="rating" v-model="comment.star" value="5">
                                    &nbsp;{{ $t('vue.cart.good') }}
                                </div>
                            </div>
                            <div class="buttons clearfix">
                                <div class="pull-right">
                                    <button type="submit" id="button-review" data-loading-text="Загрузка..."
                                            class="btn btn-primary">{{ $t('vue.cart.sending') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- #tab3 -->
                </div>
            </div>
        </div>

        <notification :product-id="this.product.id" v-if="!product.isAvailable"
                      :phone-profile="this.phoneProfile"></notification>
        <buy-one-click :product-id="this.product.id" v-if="product.isAvailable" :phone-profile="this.phoneProfile"
                       :first-name="this.firstName"></buy-one-click>
    </section>
</template>

<script>
import CommentList from '../Comment/CommentList';
import Notification from './Notification';
import BuyOneClick from './BuyOneClick';


import VueSocialSharing from 'vue-social-sharing'

export default {
    props: {
        productData: {},
        loginInfo: {},
        firstName: {},
        settingData: {},
        phoneProfile: {}
    },

    components: {
        'comment-list': CommentList,
        'ShareSocial': VueSocialSharing,
        'notification': Notification,
        'buy-one-click': BuyOneClick
    },

        created() {
            this.url = window.location.href;
        },

        data() {
            return {
                product: this.productData,
                count: 1,
                color_id: null,
                comment: {
                    star: 0,
                    body: '',
                    first_name: this.firstName
                },

                alertComment: false,

                alertBasket: false,

                colors: false,
                url: ''
            }
        },

        methods: {
            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (name) {
                    if (lang) {
                        switch(lang){
                            case "ru":
                                value = name.ru;
                                break;
                            case "uz":
                                value = name.uz;
                                break;
                            default:
                                value =  name.ru;
                                break;
                        }
                    } else {
                        value = name.ru;
                    }

                    return value;
                }
            },

            async Favorite(product) {
                var field = document.getElementById("favorite-count");
                var count = field.value;

                if (product.isFavorite === false) {
                    const { data } = await axios.get('/favorites/store/' + product.id);
                    this.product.isFavorite = true;
                    field.value = parseInt(count) + 1;
                } else {
                    const { data } = await axios.get('/favorites/delete/' + product.id);
                    this.product.isFavorite = false;
                    field.value = parseInt(count) - 1;
                }
            },

            async AddToCart() {

                if (this.product.isCart) {
                    this.$eventBus.$emit('cart-preview');
                    return;
                }

                const fields = {
                    product_id: this.product.childrens[0].id,
                    count: this.count
                };

                const { data } = await axios.post('/cart/store', fields);

                if (data.status) {
                    this.product.isCart = true;
                    var basket = document.getElementById("basket-count");
                    basket.value = data.count;
                }
            },

            CountMinus() {
                if (this.product.isAvailable) {
                    if (this.count <= 1) {
                        return 1;
                    } else {
                        this.count -= 1;
                    }
                }

            },

            CountAdd() {
                if (this.product.isAvailable && this.product.count > this.count) {
                    this.count += 1;
                }
            },

            CreditCookie() {
                this.$cookie.delete('cart-preview');
                this.$cookie.set('product-credit', this.product.id);
            },

            async StoreComment() {
                const { data } = await axios.post('/product/comment/' + this.product.id, this.comment);

                if (data.status) {
                    this.comment = {
                        star: 0,
                        body: '',
                        first_name: this.firstName
                    };

                    this.alertComment = true;
                }
            }
        }

    }
</script>

