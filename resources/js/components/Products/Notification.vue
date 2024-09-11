<template>
    <div>
        <div class="modal fade alert-when-has-product" ref="notification_available" id="alert-when-has-product">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="close" data-dismiss="modal">
                            <i class="fal fa-times"></i>
                        </button>

                        <h4>{{ $t('vue.noti.title') }}</h4>
                        <p>{{ $t('vue.noti.text') }}</p>

                        <form @submit.prevent="SendForm" class="my-form my-form__auth">
                            <div class="mt-4 my-form__group">
                                <input type="tel" v-mask="'+### ## ###-##-##'" v-model="phone" :placeholder="$t('vue.buy_one.phone_place')" id="has_productsss" required />
                                <label for="has_productsss">{{ $t('vue.buy_one.phone') }}</label>
                            </div>
                            <div class="mt-3 d-flex justify-content-md-end justify-content-center align-items-center">
                                <button type="sumbit" class="my-btn my-btn__orange">{{ $t('vue.buy_one.send') }}</button>
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
                            <h5 class="text-center px-lg-5">
                                {{ $t('vue.noti.alert') }}
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
            productId: {},
            phoneProfile: {}
        },

        data() {
            return {
                phone: this.phoneProfile,
                product_id: this.productId
            }
        },

        methods: {
            async SendForm() {
                const { data } = await axios.post('/product/notification/available', {
                    phone: this.phone,
                    product_id: this.product_id
                });

                if (data.status) {
                    if (!this.phoneProfile) {
                        this.phone = null;
                    } else {
                        this.phone = '+' + this.phoneProfile;
                    }

                    $(this.$refs.notification_available).modal('hide');
                    $(this.$refs.alertNotification).modal('show');
                }
            },

            doSomethingOnHidden(){
                alert('hidden')
            }
        }
    }
</script>

<style scoped>

</style>
