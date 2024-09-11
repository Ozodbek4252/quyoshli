<template>
<div>
    <section class="section-checkout">
        <div class="container">
            <h2 class="section-title">{{ $t('vue.cart.checkout_product') }}</h2>

            <ul class="steps" :class="!login && step === 2 ? 'steps-two' : 'steps-three'">
                <li class="steps-item">
                    <a  href="/cart">
                        {{ $t('vue.cart.step_1') }}
                    </a>
                </li>
                <li class="steps-item">
                    <a  href="javascript:void(0)" >
                        {{ $t('vue.cart.step_2') }}
                    </a>
                </li>
                <li class="steps-item">
                    <a  href="javascript:void(0)" >
                        {{ $t('vue.cart.step_3') }}
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <section class="section-basket" v-if="step === 2">
        <div class="container">
            <div class="basket__footer">

                <div class="col-md-5" v-if="user.step === 1">
                    <h4>{{ $t('app.auth.title') }}</h4>

                    <form @submit.prevent="SendForm" class="my-form my-form__auth">
                        <div class="mt-4 my-form__group">
                            <input type="tel" :placeholder="$t('app.auth.enter_phone')" v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone" required>
                            <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                        </div>

                        <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">

                            <button type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.next') }}
                            </button>
                        </div>
                    </form>
                </div>


                <div class="col-md-5" v-if="user.step === 2">
                    <h4 class="text-center">
                        {{ $t('vue.login.regg') }}
                    </h4>
                    <div class="alert alert-danger" v-if="error">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                    <span v-for="msg in error" :key="msg">
                                        {{ msg }}
                                    </span>
                            </li>
                        </ul>
                    </div>

                    <form @submit.prevent="SendForm" class="my-form my-form__auth">
                        <div class="mt-4 my-form__group">
                            <input type="tel" :placeholder="$t('app.auth.enter_phone')" disabled v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone">
                            <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                        </div>

                        <div class="mt-4 my-form__group">
                            <input type="password" :placeholder="$t('vue.login.enter_password')" v-model="user.password" id="password" required />
                            <label for="password">{{ $t('vue.login.password') }}</label>
                        </div>
                        <div class="mt-4 my-form__group">
                            <input type="password" :placeholder="$t('vue.login.re_password')" v-model="user.password_confirmation" id="login_password" required />
                            <label for="login_password">{{ $t('vue.login.re_password') }}</label>
                        </div>

                        <div class="mt-4 d-flex justify-content-between reply">
                            <div class="my-custom-control custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked id="customCheck" name="example1">
                                <label class="custom-control-label" for="customCheck" v-html="$t('vue.login.policy')">
                                </label>
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                            <button type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.reg') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-5" v-if="user.step === 3">
                    <h4 class="text-center">{{ $t('vue.login.regg') }}</h4>

                    <form @submit.prevent="SendForm" class="my-form my-form__auth">
                        <div class="mt-4 my-form__group">
                            <input type="tel" :placeholder="$t('app.auth.enter_phone')" disabled v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone">
                            <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                        </div>

                        <div class="mt-4 my-form__group">
                            <input type="text" :placeholder="$t('vue.login.enter_code')" v-model="user.verify" id="login_password" required />
                            <label for="login_password"> {{ $t('vue.login.code') }}</label>
                        </div>

                        <div class="text-danger mt-1" v-if="password_error">
                            {{ $t('vue.login.sms_empty') }}
                        </div>

                        <div class="mt-4 d-flex justify-content-md-end justify-content-center align-items-center">
                            <button type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.confirm') }}
                            </button>
                        </div>

                    </form>
                </div>

                <div class="col-md-5" v-if="user.step === 4">
                    <h4 class="text-center">
                        <h4>{{ $t('app.auth.title') }}</h4>
                    </h4>

                    <form @submit.prevent="SendForm" class="my-form my-form__auth">
                        <div class="mt-4 my-form__group">
                            <input type="tel" :placeholder="$t('app.auth.enter_phone')" disabled v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone">
                            <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                        </div>

                        <div class="mt-4 my-form__group">
                            <input type="password" v-model="user.password" :placeholder="$t('vue.login.password')" id="login_password" required />
                            <label for="login_password"> {{ $t('vue.login.password') }}</label>
                        </div>

                        <div class="text-danger mt-1" v-if="password_error">
                            {{ $t('vue.login.pass_err') }}
                        </div>

                        <div class="mt-4 d-flex justify-content-between reply">
                            <div class="my-custom-control custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" v-model="user.remember" name="remember">
                                <label class="custom-control-label" for="remember">
                                    {{ $t('vue.login.remember') }}
                                </label>
                            </div>
                            <a href="#" @click="user.step = 5 " class="reset-password text-primary">
                                {{ $t('vue.login.restore') }}
                            </a>
                        </div>

                        <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                            <button type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('app.layout.login') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-5" v-if="user.step === 5 || user.step === 6 || user.step === 7">
                    <h4 class="text-center">
                        {{ $t('vue.login.restore_pass') }}
                    </h4>

                    <div class="alert alert-danger" v-if="error">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                    <span v-for="msg in error" :key="msg">
                                        {{ msg }}
                                    </span>
                            </li>
                        </ul>
                    </div>

                    <form  @submit.prevent="SendForm"  class="my-form my-form__auth">

                        <div class="mt-4 my-form__group" v-if="user.step === 5 || user.step === 6  || user.step === 7 ">
                            <input type="tel" :placeholder="$t('app.auth.enter_phone')" disabled v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone">
                            <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                        </div>

                        <div class="mt-4 my-form__group" v-if="user.step === 7">
                            <input type="password" :placeholder="$t('vue.login.new_password')" v-model="user.password" id="sss" required />
                            <label for="sss">
                                {{ $t('vue.login.new_password') }}
                            </label>
                        </div>
                        <div class="mt-4 my-form__group" v-if="user.step === 7">
                            <input type="password"  :placeholder="$t('vue.login.new_re_password')" v-model="user.password_confirmation" id="new_re_password" required />
                            <label for="new_re_password">
                                {{ $t('vue.login.new_re_password') }}
                            </label>
                        </div>



                        <div class="mt-4 my-form__group" v-if="user.step === 6">
                            <input type="text" :placeholder="$t('vue.login.enter_code')" v-model="user.verify" id="login_password" required />
                            <label for="login_password">{{ $t('vue.login.code') }}</label>
                        </div>

                        <div class="text-danger mt-1" v-if="user.step === 6 && password_error">
                            {{ $t('vue.login.sms_empty') }}
                        </div>


                        <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                            <button v-if="user.step === 5" type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.next') }}
                            </button>

                            <button v-if="user.step === 6" type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.confirm') }}
                            </button>

                            <button v-if="user.step === 7" type="sumbit" class="my-btn my-btn__orange w-100">
                                {{ $t('vue.login.restore_confirm') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <section class="section-checkout" v-if="step === 3">
        <div class="container">
            <div class="col-12" v-if="!deliveryInfo && !pickupInfo">
                <div class="row">
                    <div class="alert alert-info w-100">
                        <i class="fa fa-info-circle"></i> {{ $t('vue.checkout.no_ordered') }}
                    </div>
                </div>
            </div>
            <form @submit.prevent="SendOrder" class="my-form my-form__checkout" v-if="pickupInfo || deliveryInfo">
                <div class="row mb-5">
                    <div class="col-md-7">
                        <h3 class="mt-4 mb-3">{{ $t('vue.checkout.delivery_title') }}</h3>
                        <div class="form-payment">
                            <div class="custom-control custom-radio custom-control-inline" v-if="pickupInfo">
                                <input type="radio" class="custom-control-input" id="delivery1" name="delivery" v-model="order.delivery_type"  value="pickup">
                                <label class="custom-control-label" for="delivery1">{{ $t('vue.checkout.delivery_pickup') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline" v-if="deliveryInfo">
                                <input type="radio" class="custom-control-input" id="delivery2" name="delivery" v-model="order.delivery_type" value="delivery">
                                <label class="custom-control-label" for="delivery2">{{ $t('vue.checkout.delivery_courier') }}</label>
                            </div>
                        </div>

                        <div v-if="order.delivery_type === 'delivery' && deliveryInfo">



                            <h3 class="mt-4 mb-3">{{ $t('vue.checkout.delivery_about') }}</h3>

                            <div class="row mb-3">
                                <div class="col-md-5 align-items-start justify-content-center d-flex flex-column">
                                    <h4>{{ $t('vue.checkout.first_name') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <input type="text" placeholder="" required v-model="address.first_name" id="first_name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 align-items-start justify-content-center d-flex flex-column">
                                    <h4>{{ $t('vue.checkout.delivery_region') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <select name="regions" class="custom-select" @change="changeRegion($event)" v-model="address.region_id">
                                        <option v-for="(region, index) in regions" :value="index" :selected="index === 0 ? 'selected' : false" >
                                            {{ getName(region.name) }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 align-items-start justify-content-center d-flex flex-column">
                                    <h4>{{ $t('vue.checkout.delivery_city') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <select name="cities" class="custom-select" v-model="address.city_id">
                                        <option v-for="(city, index) in cities"  :value="city.id" :selected="index === 0 ? 'selected' : false">
                                            {{ getName(city.name) }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 align-items-start justify-content-center d-flex flex-column">
                                    <h4>{{ $t('vue.checkout.delivery_address') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <input type="text" placeholder="" v-model="address.address" required id="your_address">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 align-items-start justify-content-center d-flex flex-column">
                                    <h4>{{ $t('vue.checkout.delivery_additional_info') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <input type="text" placeholder="" v-mask="'+998 (##) ###-##-##'" v-model="address.other_phone" id="your_contact">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <h4>{{ $t('vue.checkout.delivery_cemments') }}</h4>
                                </div>
                                <div class="col-md-7 my-form__group">
                                    <textarea cols="30" v-model="address.comment" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                        <div v-if="order.delivery_type === 'pickup' && pickupInfo">
                            <div class="alert alert-info" v-html="getName(pickupText)">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5" >
                        <div class="all_sum">
                            <div class="row mb-3 mb-md-0">
                                <div class="col-md-6 mb-md-2">
                                    <span>{{ $t('vue.checkout.delivery_total_cost') }}</span>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <span>{{ prices | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</span>
                                </div>
                            </div>

<!--                            <div class="row mb-3 mb-md-0">-->
<!--                                <div class="col-md-6 mb-md-2">-->
<!--                                    <span>Промокод:</span>-->
<!--                                    <a href="#" class="d-block">Ввести другой промокод</a>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 text-md-right">-->
<!--                                    <span>RY38990</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row mb-3 mb-md-0">-->
<!--                                <div class="col-md-6 mb-md-2">-->
<!--                                    <span>Скидка по промокоду:</span>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 text-md-right">-->
<!--                                    <span>56 000 сум</span>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="row mb-3 mb-md-0" v-if="order.delivery_type === 'delivery' && deliveryInfo && order.delivery_price > 0">
                                <div class="col-md-6 mb-md-2">
                                    <span>{{ $t('vue.checkout.delivery_price') }}:</span>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <span>{{ order.delivery_price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3 mb-md-0">
                                <div class="col-md-6 mb-md-2">
                                    <span>{{ $t('vue.checkout.delivery_total_amount') }}:</span>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <span>{{ order.delivery_type === 'delivery' ? prices + order.delivery_price : prices | number('0,0', { thousandsSeparator: ' ' })  }} {{ $t('app.sum') }}</span>
                                </div>
                            </div>
                        </div>

                        <h3 class="mt-4 mb-3">{{ $t('vue.checkout.delivery_about_price') }}</h3>
                        <div class="form-payment">
                            <div class="custom-control custom-radio custom-control-inline" v-if="cash">
                                <input type="radio" class="custom-control-input" id="payment-1" name="payment_type" value="cash" v-model="order.payment_type" checked="">
                                <label class="custom-control-label" for="payment-1">{{ $t('vue.checkout.delivery_in_cash') }}</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="payment-2" value="apelsin" v-model="order.payment_type" name="payment_type">
                                <label class="custom-control-label" for="payment-2">Apelsin</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="payment-3" value="payme" v-model="order.payment_type" name="payment_type">
                                <label class="custom-control-label" for="payment-3">Payme</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="payment-4" value="click" v-model="order.payment_type" name="payment_type">
                                <label class="custom-control-label" for="payment-4">Click</label>
                            </div>
                        </div>

                        <div class="alert alert-danger" v-if="error">
                            <ul>
                                <li v-for="(error, index) in errors" v-if="error_type === 'available'" :key="index">
                                        {{ error }}
                                </li>

                                <li v-for="(error, index) in errors" v-if="error_type === 'validation'" :key="index">

                                    <span v-for="msg in error"  :key="msg">
                                        {{ msg }}
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-md-start justify-content-center">
                            <button type="sumbit" class="my-btn my-btn__orange">{{ $t('vue.cart.checkout_product') }}</button>
                        </div>
                    </div>
                </div>
            </form>
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
            regionsData: {},
            deliveryPrice: {},
            pickupInfo: {},
            deliveryInfo: {},
            pickupText: {},
            firstName: {},
            addressData: {}
        },

        watch: {
          'order.delivery_type': function (newVal, oldVal) {
                this.order.delivery_type = newVal;
          },
        },

        data() {
            return {
                user: {
                    phone: null,
                    verify: null,
                    password: null,
                    password_confirmation: null,
                    remember: false,
                    step: 1,
                },

                prices: this.pricesData,

                address: {
                    first_name: this.firstName,
                    region_id: 0,
                    city_id: null,
                    address: this.addressData,
                    other_phone: null,
                    comment: null
                },

                order: {
                    delivery_type: this.deliveryInfo ? 'delivery' : 'pickup',
                    delivery_price: this.deliveryInfo ? this.deliveryPrice : 0,
                    payment_type: 'cash'
                },

                regions: this.regionsData,
                cities: [],

                verify: false,

                step: this.loginInfo ? 3 : 2,

                error: false,
                errors: [],
                error_type: null,

                password_error: false,
                cash: true,

                login: this.loginInfo
            }
        },

        mounted() {
            this.cities = this.regions[0].cities;
            this.address.city_id = this.cities[0] ? this.cities[0].id : null;
        },

        methods: {

            async SendForm () {

                if (this.user.step === 1) {
                    const { data } = await axios.post('/auth/login', {
                        phone: this.user.phone
                    });

                    this.user.step = data.step;
                    // this.verify = true;
                } else if (this.user.step === 2) {
                    try {
                        const { data } = await axios.post('/auth/register', {
                            phone: this.user.phone,
                            password: this.user.password,
                            password_confirmation: this.user.password_confirmation,
                        });

                        this.user.step = data.step;
                    } catch (error) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                }  else if (this.user.step === 3) {
                    try {
                        const { data } = await axios.post('/auth/verify', {
                            phone: this.user.phone,
                            code: this.user.verify,
                            //type: type,
                            //action: action
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });
                        if (data.status) {
                            this.login = true;
                            this.step = 3;
                            this.error = false;
                            this.address.first_name = data.first_name;
                            this.address.address = data.address
                        }
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.user.step === 4 ) {
                    try {
                        const { data } = await axios.post('/auth/password', {
                            phone: this.user.phone,
                            password: this.user.password,
                            //type: type,
                            //action: action,
                            remember: this.user.remember
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });

                        if (data.status) {
                            this.login = true;
                            this.step = 3;
                            this.error = false;
                            this.address.first_name = data.first_name;
                            this.address.address = data.address
                        }
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.user.step === 5) {
                    try {
                        const { data } = await axios.post('/auth/restore', {
                            phone: this.user.phone,
                        });

                        this.user.step = data.step;
                    } catch (error) {

                    }
                }  else if (this.user.step === 6) {
                    try {
                        const { data } = await axios.post('/auth/restore/verify', {
                            phone: this.user.phone,
                            code: this.user.verify
                        });

                        this.user.password = null;
                        this.user.password_confirmation = null;

                        this.user.step = data.step;
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.user.step === 7) {
                    try {
                        const { data } = await axios.post('/auth/restore/confirm', {
                            phone: this.user.phone,
                            password: this.user.password,
                            password_confirmation: this.user.password_confirmation,
                            //type: type,
                            //action: action
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });
                        if (data.status) {
                            this.login = true;
                            this.step = 3;
                            this.error = false;
                            this.address.first_name = data.first_name;
                            this.address.address = data.address
                        }
                    } catch (error) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                }




            },

            // async LoginSend() {
            //     if (!this.verify) {
            //         const { data } = await axios.post('/auth/login', {
            //             phone: this.user.phone
            //         });
            //
            //         this.verify = true;
            //     } else {
            //
            //         try {
            //             const { data } = await axios.post('/auth/verify', this.user);
            //             if (data.status) {
            //                 this.login = true;
            //                 this.step = 3;
            //                 this.error = false;
            //                 this.address.first_name = data.first_name;
            //                 this.address.address = data.address
            //             }
            //         } catch (error) {
            //             this.error = true;
            //         }
            //     }
            // },

            async Resend () {
                if (this.verify) {
                    await axios.post('/api/auth/login', {
                        phone: this.user.phone
                    });
                }
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

            async SendOrder() {
                var product_id = [];

                for (var i = 0; i < this.cartData.length; i++) {
                    product_id.push(this.cartData[i].id);
                }

                const fields = {
                    delivery_type: this.order.delivery_type,
                    delivery_price: this.order.delivery_price,
                    payment_type: this.order.payment_type,
                    products: product_id,

                    address: this.address,
                };

                try {
                    const { data } = await axios.post('/checkout', fields);
                    if (data.status) {
                        window.location.href = data.url
                    } else {
                        this.error = true;
                        this.errors = data.errors;
                        this.error_type = 'available';
                    }
                } catch (err) {
                    if (err.response.status === 422) {
                        this.error = true;
                        this.errors = err.response.data.errors;
                        this.error_type = 'validation';

                    }
                }
            },

            changeRegion(event) {
                let index = parseInt(event.target.value);
                this.cash = this.regions[index].cash;

                if (this.cash) {
                    this.order.payment_type = 'cash'
                } else {
                    this.order.payment_type = 'payme'
                }

                this.cities = this.regions[index].cities;

                this.address.city_id = this.cities[0] ? this.cities[0].id : null;
            }
        }
    }
</script>

<style scoped>

</style>
