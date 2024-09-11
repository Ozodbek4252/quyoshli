<template>
    <div class="modal fade login" id="login">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close" data-dismiss="modal">
                        <i class="fal fa-times"></i>
                    </button>

                    <div v-if="step === 1">
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


                   <div v-if="step === 2">
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

                    <div v-if="step === 3">
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

                    <div v-if="step === 4">
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
                              <a href="#" @click="step = 5 " class="reset-password text-primary">
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

                    <div v-if="step === 5 || step === 6 || step === 7">
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

                            <div class="mt-4 my-form__group" v-if="step === 7">
                                <input type="password" :placeholder="$t('vue.login.new_password')" v-model="user.password" id="password" required />
                                <label for="password">
                                    {{ $t('vue.login.new_password') }}
                                </label>
                            </div>
                            <div class="mt-4 my-form__group" v-if="step === 7">
                                <input type="password"   :placeholder="$t('vue.login.new_re_password')" v-model="user.password_confirmation" id="login_password" required />
                                <label for="login_password">
                                    {{ $t('vue.login.new_re_password') }}
                                </label>
                            </div>

                            <div class="mt-4 my-form__group" v-if="step === 5 || step === 6 ">
                                <input type="tel" :placeholder="$t('app.auth.enter_phone')" disabled v-mask="'+998 (##) ###-##-##'" v-model="user.phone" id="login_phone">
                                <label for="login_phone">{{ $t('app.auth.phone') }}</label>
                            </div>

                            <div class="mt-4 my-form__group" v-if="step === 6">
                                <input type="text" :placeholder="$t('vue.login.enter_code')" v-model="user.verify" id="login_password" required />
                                <label for="login_password">{{ $t('vue.login.code') }}</label>
                            </div>

                            <div class="text-danger mt-1" v-if="step === 6 && password_error">
                                {{ $t('vue.login.sms_empty') }}
                            </div>


                            <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                                <button v-if="step === 5" type="sumbit" class="my-btn my-btn__orange w-100">
                                    {{ $t('vue.login.next') }}
                                </button>

                                <button v-if="step === 6" type="sumbit" class="my-btn my-btn__orange w-100">
                                    {{ $t('vue.login.confirm') }}
                                </button>

                                <button v-if="step === 7" type="sumbit" class="my-btn my-btn__orange w-100">
                                    {{ $t('vue.login.restore_confirm') }}
                                </button>
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
        name: "Login",

        props: ['url'],

        data: () => ({
            user: {
                phone: null,
                verify: null,
                password: null,
                password_confirmation: null,
                remember: false
            },

            step: 1,
            verify: false,

            error: false,
            errors: [],
            password_error: false
        }),


        methods: {
            async SendForm () {

                if (this.step === 1) {
                    const { data } = await axios.post('/auth/login', {
                        phone: this.user.phone
                    });

                    this.step = data.step;
                    // this.verify = true;
                } else if (this.step === 2) {
                    try {
                        const { data } = await axios.post('/auth/register', {
                            phone: this.user.phone,
                            password: this.user.password,
                            password_confirmation: this.user.password_confirmation,
                        });

                        this.step = data.step;
                    } catch (error) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                }  else if (this.step === 3) {
                    try {
                        let type;
                        let action;

                        if (this.$cookie.get('product-credit')) {
                            type = 'product-credit';
                            action = this.$cookie.get('product-credit');
                        } else if (this.$cookie.get('cart-preview')) {
                            type = 'cart-preview';
                            action = 'cart-preview';
                        } else {
                            type = 'auth';
                            action = null;
                        }

                        const { data } = await axios.post('/auth/verify', {
                            phone: this.user.phone,
                            code: this.user.verify,
                            type: type,
                            action: action
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });
                        if (data.status) {
                            switch (data.action) {
                                case 'cart-preview':
                                    window.location.href = data.url;
                                    this.$cookie.delete('cart-preview');
                                    break;
                                case 'product-credit':
                                    window.location.href = data.url;
                                    this.$cookie.delete('product-credit');
                                    break;
                                default:
                                    location.reload();
                                    this.$cookie.delete('product-credit');
                                    this.$cookie.delete('cart-preview');
                                    break;
                            }

                        }
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.step === 4 ) {
                    try {
                        let type;
                        let action;

                        if (this.$cookie.get('product-credit')) {
                            type = 'product-credit';
                            action = this.$cookie.get('product-credit');
                        } else if (this.$cookie.get('cart-preview')) {
                            type = 'cart-preview';
                            action = 'cart-preview';
                        } else {
                            type = 'auth';
                            action = null;
                        }

                        const { data } = await axios.post('/auth/password', {
                            phone: this.user.phone,
                            password: this.user.password,
                            type: type,
                            action: action,
                            remember: this.user.remember
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });

                        if (data.status) {
                            switch (data.action) {
                                case 'cart-preview':
                                    window.location.href = data.url;
                                    this.$cookie.delete('cart-preview');
                                    break;
                                case 'product-credit':
                                    window.location.href = data.url;
                                    this.$cookie.delete('product-credit');
                                    break;
                                default:
                                    location.reload();
                                    this.$cookie.delete('product-credit');
                                    this.$cookie.delete('cart-preview');
                                    break;
                            }

                        }
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.step === 5) {
                    try {
                        const { data } = await axios.post('/auth/restore', {
                            phone: this.user.phone,
                        });

                        this.step = data.step;
                    } catch (error) {

                    }
                }  else if (this.step === 6) {
                    try {
                        const { data } = await axios.post('/auth/restore/verify', {
                            phone: this.user.phone,
                            code: this.user.verify
                        });

                        this.user.password = null;
                        this.user.password_confirmation = null;

                        this.step = data.step;
                    } catch (error) {
                        this.password_error = true;
                    }
                } else if (this.step === 7) {
                    try {
                        let type;
                        let action;

                        if (this.$cookie.get('product-credit')) {
                            type = 'product-credit';
                            action = this.$cookie.get('product-credit');
                        } else if (this.$cookie.get('cart-preview')) {
                            type = 'cart-preview';
                            action = 'cart-preview';
                        } else {
                            type = 'auth';
                            action = null;
                        }

                        const { data } = await axios.post('/auth/restore/confirm', {
                            phone: this.user.phone,
                            password: this.user.password,
                            password_confirmation: this.user.password_confirmation,
                            type: type,
                            action: action
                            //credit: this.$cookie.get('product-credit') ? this.$cookie.get('product-credit') : null,
                        });
                        if (data.status) {
                            switch (data.action) {
                                case 'cart-preview':
                                    window.location.href = data.url;
                                    this.$cookie.delete('cart-preview');
                                    break;
                                case 'product-credit':
                                    window.location.href = data.url;
                                    this.$cookie.delete('product-credit');
                                    break;
                                default:
                                    location.reload();
                                    this.$cookie.delete('product-credit');
                                    this.$cookie.delete('cart-preview');
                                    break;
                            }

                        }
                    } catch (error) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                }




            },

            async Resend () {
                if (this.verify) {
                    await axios.post('/api/auth/login', {
                        phone: this.user.phone
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
