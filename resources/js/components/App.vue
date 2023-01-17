<template>
    <navbar></navbar>
    <div class="app">
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from "./Navbar";
import axios from "axios";

export default {
    name: "App",
    components: {Navbar},
    created: function () {

        let store = this.$store;
        let router = this.$router;

        // проверка не протух ли токен
        // перехватываем все не прошедшие запросы через аксиос
        axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {
                if (err.response.status === 401 && err.config && !err.config.__isRetryRequest) {
                    store.dispatch('auth/logout');
                    next('/login');
                }
                throw err;
            });
        });
    },
    mounted() {
        // console.log(this.$store)
    }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
h1  {
    margin-bottom: 30px;
}
.app {
    padding: 20px;
}
</style>
