<template>
    <div>
        <div class="modal fade buy-by-one-click" ref="buy_one_click" id="buy-by-one-click">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">
                            <i class="fal fa-times"></i>
                        </button>

                        <h4>{{ $t('vue.buy_one.title') }}</h4>

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
                                <input type="text" placeholder="" v-model="first_name" id="your_name2" required />
                                <label for="your_name2">{{ $t('vue.buy_one.first_name') }}</label>
                            </div>
                            <div class="mt-4 my-form__group">
                                <input type="tel" :placeholder="$t('vue.buy_one.phone_place')" v-model="phone" v-mask="'+### ## ###-##-##'" id="phoneee" required />
                                <label for="phoneee">{{ $t('vue.buy_one.phone') }}</label>
                            </div>
                            <div class="mt-4 my-form__group">
                                <input type="email" placeholder="" v-model="email" id="your_name"  />
                                <label for="your_name">{{ $t('vue.buy_one.email') }}</label>
                            </div>
                            <div class="mt-4 my-form__group">
                                <textarea name="" id="your_message2" v-model="comment" cols="30" rows="5"></textarea>
                                <label for="your_message2">{{ $t('vue.buy_one.comment') }}</label>
                            </div>
                            <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                                <button type="sumbit" class="my-btn my-btn__orange">
                                    {{ $t('vue.buy_one.send') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade success" ref="alertNotification">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="/vendor/site/img/tick.png" alt="Tick icon">
                        <div class="my-3">
                            <h4 class="text-center">
                                {{ $t('vue.buy_one.thx') }}
                            </h4>
                            <h5 class="text-center px-lg-5">
                                {{ $t('vue.buy_one.thx_text') }}
                            </h5>
                        </div>
                        <div class="mt-4">
                            <button type="button" data-dismiss="modal" class="my-btn my-btn__orange">{{ $t('vue.noti.ok') }}</button>
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
            phoneProfile: {},
            productId: {},
            firstName: {}
        },

        data() {
            return {
                phone: this.phoneProfile,
                first_name: this.firstName,
                email: null,
                comment: null,
                product_id: this.productId,

                error: false,
                errors: []
            }
        },

        methods: {
            SendForm() {
                const field = {
                    phone: this.phone,
                    first_name: this.first_name,
                    email: this.email,
                    comment: this.comment,
                    product_id: this.product_id
                };

                axios.post('/product/buy/click', field).then((response) => {
                    if (response.data.status) {
                        $(this.$refs.buy_one_click).modal('hide');
                        $(this.$refs.alertNotification).modal('show');

                        this.phone = this.phoneProfile;
                        this.first_name = null;
                        this.email = null;
                        this.comment = null
                    }
                }).catch((error) => {
                    if (error.response) {
                        this.error = true;
                        this.errors = error.response.data.errors;
                    }
                });


            }
        }
    }
</script>

<style scoped>

</style>w
