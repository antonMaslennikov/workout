<template>
    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form @submit.prevent="register">

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Регистрация</h5>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example1">Имя</label>
                                            <input type="text" id="form2Example1" class="form-control form-control-lg" v-model="name" />
                                            <div class="text-danger">{{ $store.getters['nameError'] }}</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example2">Email</label>
                                            <input type="email" id="form2Example2" class="form-control form-control-lg" v-model="email" required autofocus />
                                            <div class="text-danger">{{ $store.getters['emailError'] }}</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example3">Пароль</label>
                                            <input type="password" id="form2Example3" class="form-control form-control-lg" v-model="password" require />
                                            <div class="text-danger">{{ $store.getters['passwordError'] }}</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example4">Пароль ещё раз</label>
                                            <input type="password" id="form2Example4" class="form-control form-control-lg" v-model="password_confirmation" require />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block">Войти</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Register",
    data(){
        return {
            name : "",
            email : "",
            password : "",
            password_confirmation : "",
            is_admin : null
        }
    },
    methods: {
        register: function () {
            let data = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                is_admin: this.is_admin
            }
            this.$store.dispatch('register', data)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

</style>
