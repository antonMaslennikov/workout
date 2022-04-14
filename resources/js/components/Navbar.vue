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
<!--                    <li class="nav-item" v-if="isLoggedIn">-->
<!--                        <a class="nav-link" href="#" @click="$router.push('/activities')">Упражнения</a>-->
<!--                    </li>-->
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/plans')">Тренировочные планы</a>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <a class="nav-link" href="#" @click="$router.push('/food')">Питание</a>
                    </li>
                    <template v-if="isLoggedIn">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               id="navbarDropdownMenuLink"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">{{ $store.getters['auth/userLogin'] }}</a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#" @click="$router.push('/profile')">Профиль</a></li>
                                <li><a class="dropdown-item" href="/admin" v-if="$store.state.auth.user.id == 1">Админская панель</a></li>
                                <li><a class="dropdown-item" href="#" @click="logout">Выход</a></li>
                            </ul>
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
        isLoggedIn : function(){ return this.$store.getters['auth/isLoggedIn'] }
    },
    methods: {
        logout: function () {
            this.$store.dispatch('auth/logout')
                .then(() => {
                    this.$router.push('/login')
                })
        }
    },
}
</script>

<style scoped>
</style>
