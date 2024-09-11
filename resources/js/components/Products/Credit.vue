<template>
    <div>
        <div class="modal fade installment" id="installment" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <!--  -->
                        <button class="close" data-dismiss="modal"><i class="fal fa-times"></i></button>

                        <div>
                            <h4 class="text-center">{{ $t('app.credit.title') }}</h4>

                            <ul class="nav nav-pills justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#by_alifmoliya">Alif Moliya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#by_apelsin">Apelsin</a>
                                </li>
                            </ul>

                            <hr>

                            <div class="tab-content">
                                <div class="tab-pane container p-0 active" id="by_alifmoliya">
                                    <form class="my-form my-form__auth">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="my-form__group">
                                                    <input class="payment-price" readonly
                                                           :value="firstPay | number('0,0', { thousandsSeparator: ' ' })" type="number" id="initial-payment"
                                                           required="">
                                                    <label for="initial-payment">{{ $t('app.credit.alif.first_pay') }}</label>
                                                </div>
                                                <div class="small mt-1"><i class="fal fa-info-circle"></i> {{ $t('app.credit.alif.min_pay') }} {{ product.first_pay }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-md-0 mt-4 my-form__group">
                                                    <label>{{ $t('app.credit.alif.months') }}</label>
                                                    <div
                                                        class="d-flex justify-content-center align-items-center select-months">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input months"
                                                                   id="month6" v-model="months" @change="handleMonth"
                                                                   :value="6">
                                                            <label class="custom-control-label" for="month6">6
                                                                {{ $t('app.credit.month') }}</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input months"
                                                                   id="month9" v-model="months" @change="handleMonth"
                                                                   :value="9">
                                                            <label class="custom-control-label" for="month9">9
                                                                {{ $t('app.credit.month') }}.</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input months"
                                                                   id="month12" v-model="months" @change="handleMonth"
                                                                   :value="12">
                                                            <label class="custom-control-label" for="month12">12
                                                                {{ $t('app.credit.month') }}</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" class="custom-control-input months"
                                                                   id="month3" v-model="months" @change="handleMonth"
                                                                   :value="15">
                                                            <label class="custom-control-label" for="month3">15
                                                                {{ $t('app.credit.month') }}.</label>
                                                        </div>
                                                        <!-- <div class="custom-control custom-radio custom-control-inline">
                                                          <input type="radio" class="custom-control-input" id="month15" name="months"
                                                            value="customEx">
                                                          <label class="custom-control-label" for="month15">15 мес.</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                          <input type="radio" class="custom-control-input" id="month18" name="months"
                                                            value="customEx">
                                                          <label class="custom-control-label" for="month18">18 мес.</label>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-4 my-form__group">
                                                    <input type="text" disabled="" :value="perMonth | number('0,0', { thousandsSeparator: ' ' })"
                                                           id="for_month" class="payment-price">
                                                    <label for="for_month">{{ $t('app.credit.alif.per_month') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-4 my-form__group">
                                                    <input type="text" disabled=""
                                                           :value="price | number('0,0', { thousandsSeparator: ' ' })"
                                                           class="payment-price" id="all_price">
                                                    <label for="all_price">{{ $t('app.credit.alif.price') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6" v-if="phoneVerify">
                                                <div class="mt-4 my-form__group">
                                                    <input type="tel"
                                                           v-model="phone"
                                                           v-mask="'+998 (##) ###-##-##'"
                                                           class="payment-price" id="phone">
                                                    <label for="phone">{{ $t('app.credit.alif.phone') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6" v-if="phoneVerify">
                                                <div class="mt-4 my-form__group" v-if="showVerify">
                                                    <input type="text"
                                                           v-mask="'####'"
                                                           v-model="verify"
                                                           class="payment-price" id="verify">
                                                    <label for="verify">{{ $t('app.credit.alif.verify_code') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-auto mt-3">
                                                <div
                                                    class="mt-4 d-flex justify-content-md-end justify-content-center align-items-center">
                                                    <button v-if="!phoneVerify" @click="showPhoneVerify" type="button" class="my-btn my-btn__orange w-100">
                                                        {{ $t('app.credit.btn') }}
                                                    </button>
                                                    <button v-if="phoneVerify && !showVerify" @click="sendPhone" type="button" class="my-btn my-btn__orange w-100">
                                                        {{ $t('app.credit.btn') }}
                                                    </button>
                                                    <button v-if="showVerify" @click="submit" type="button" class="my-btn my-btn__orange w-100">
                                                        {{ $t('app.credit.btn') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane container p-0 fade" id="by_apelsin">
                                    <div class="mt-3">
                                        <p>{{ $t('app.credit.apelsin_text') }}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mx-auto mt-3">
                                            <a :href="`/product/oncredit/${product.id}`">
                                                <button class="my-btn my-btn__orange w-100">{{ $t('app.credit.btn') }}</button>
                                            </a>
                                        </div>
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
    name: "Credit",
    props: {
        productData: {}
    },
    data() {
        return {
            product: this.productData,
            firstPay: 0,
            perMonth: this.productData.per_month,
            price: Math.round(this.productData.price + (this.productData.price / 100) * 25),
            months: 6,
            phoneVerify: false,
            showVerify: false,
            phone: null,
            verify: null
        }
    },
    methods: {
        handleFirstPay(event) {
            if ((parseInt(event.target.value) < parseInt(this.product.first_pay)) || (parseInt(event.target.value) > parseInt(this.price)) || !event.target.value) {
                this.firstPay = this.product.first_pay
            } else {
                this.perMonth = Math.round((this.price - this.firstPay) / this.months)
            }
        },

        handleMonth(event) {
            switch (this.months) {
                case 6:
                    this.price = Math.round(this.product.price + (this.product.price / 100) * 25)
                    break
                case 9:
                    this.price = Math.round(this.product.price + (this.product.price / 100) * 32)
                    break
                case 12:
                    this.price = Math.round(this.product.price + (this.product.price / 100) * 38)
                    break
                case 15:
                    this.price = Math.round(this.product.price + (this.product.price / 100) * 50)
                    break
            }
            this.months = parseInt(event.target.value)
            this.perMonth = Math.round((this.price - this.firstPay) / parseInt(event.target.value))

        },

        showPhoneVerify(event) {
            this.phoneVerify = true
        },

        sendPhone(event) {
            axios.post('/product/phone-verify/', {phone: this.phone}).then(response => {
                this.showVerify = true
            })
        },

        submit() {
            const form = new FormData()

            form.append('phone', this.phone)
            form.append('code', this.verify)
            form.append('duration', this.months)
            axios.post(`/product/oncredit/${this.product.id}`, form).then(response => {
                $('#installment').modal('hide')
                $('#success').modal('show')
            })
        }
    }
}
</script>

<style scoped>
#initial-payment {
    -webkit-appearance: none;
    margin: 0;
    -moz-appearance: textfield;
}
</style>
