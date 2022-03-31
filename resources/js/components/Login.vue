<template>
    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form @submit.prevent="login">

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Вход</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" class="form-control form-control-lg" v-model="email" />
                                            <label class="form-label" for="form2Example17">Email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" class="form-control form-control-lg" v-model="password" />
                                            <label class="form-label" for="form2Example27">Пароль</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block">Войти</button>
                                        </div>

                                        <p class="" style="color: #393f81;"><a href="#" @click="$router.push('/register')" style="color: #393f81;">Регистрация</a></p>
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
    name: "Login",
    data() {
        return {
            email : "admin@admin.ru",
            password : "admin"
        }
    },
    methods: {
        login() {
            let email = this.email
            let password = this.password
            this.$store.dispatch('login', { email, password })
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

</style>
