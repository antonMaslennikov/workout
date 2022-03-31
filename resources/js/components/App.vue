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
        // проверка не протух ли токен
        axios.interceptors.response.use(undefined, function (err) {
            return new Promise(function (resolve, reject) {
                if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                    this.$store.dispatch("logout")
                }
                throw err;
            });
        });
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
