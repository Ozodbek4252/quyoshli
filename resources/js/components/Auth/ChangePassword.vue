<template>
    <div class="modal fade login" id="password-edit">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="close" data-dismiss="modal">
                        <i class="fal fa-times"></i>
                    </button>

                    <!-- Изменить пароль-Password -->
                    <div>
                        <h4 class="text-center">{{ $t('vue.change_password.title') }}</h4>

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
                                <input type="password" :placeholder="$t('vue.change_password.enter_current')" v-model="user.current_password" id="login_password1" required />
                                <label for="login_password1">{{ $t('vue.change_password.current') }}</label>
                            </div>
                            <div class="mt-4 my-form__group">
                                <input type="password" :placeholder="$t('vue.login.enter_new_password')" v-model="user.password"  id="login_password2" required />
                                <label for="login_password2">{{ $t('vue.login.new_password') }}</label>
                            </div>
                            <div class="mt-4 my-form__group">
                                <input type="password" :placeholder="$t('vue.login.enter_new_re_password')"  v-model="user.password_confirmation"  id="login_password3" required />
                                <label for="login_password3">{{ $t('vue.login.new_re_password') }}</label>
                            </div>

                            <div class="mt-4 d-flex justify-content-md-end justify-content-center align-items-center">
                                <button type="submit" class="my-btn my-btn__orange w-100">
                                    {{ $t('vue.change_password.save') }}
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
        data: () => ({
            user: {
                current_password: null,
                password: null,
                password_confirmation: null,
            },

            error: false,
            errors: []
        }),

        methods: {
            async SendForm() {
                try {
                    const { status } = await axios.post('/profile/password/update', this.user);

                    if (status === 200) {
                        location.reload();
                    }
                } catch (error) {
                    this.error = true;
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
</script>

<style scoped>

</style>
