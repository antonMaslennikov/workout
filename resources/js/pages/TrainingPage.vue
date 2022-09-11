<template>

    <h1>Тренировка</h1>

    <One :id="$route.params.id"></One>

</template>

<script>
import One from "../components/trainings/One";
export default {
    name: "TrainingPage",
    components: {One}
}
</script>

<style scoped>

</style>
