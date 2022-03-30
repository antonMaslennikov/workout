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
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$router.push('/activities')">Упражнения</a>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="#" @click="$router.push('/activities-composition')">Упражнения (composition Api)</a>-->
<!--                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$router.push('/activities-store')">Упражнения (store)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$router.push('/plans')">Тренировочные планы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" @click="$router.push('/food')">Питание</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style scoped>
</style>
