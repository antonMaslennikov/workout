<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$router.push('/')">Главная</a>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/calendar')">Календарь</a>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="#" @click="$router.push('/activities')">Упражнения</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="#" @click="$router.push('/activities-composition')">Упражнения (composition Api)</a>-->
<!--                    </li>-->
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/activities')">Упражнения</a>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/plans')">Тренировочные планы</a>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/food')">Питание</a>
                    </li>
                    <template v-if="isLoggedIn">
                        <li class="nav-item">
                            <a class="nav-link" href="#" @click="$router.push('/profile')">Профиль ({{ $store.getters.userLogin }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" @click="logout">Выход</a>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <a class="nav-link" href="#" @click="$router.push('/login')">Вход</a>
                        </li>
                    </template>

                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
  name: "Navbar",
    computed : {
        isLoggedIn : function(){ return this.$store.getters.isLoggedIn}
    },
    methods: {
        logout: function () {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                })
        }
    },
}
</script>

<style scoped>
</style>
