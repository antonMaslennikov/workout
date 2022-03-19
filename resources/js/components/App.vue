<template>
    <navbar></navbar>
    <div class="app">
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from "./Navbar";
export default {
    name: "App",
    components: {Navbar}
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
