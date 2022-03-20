<template>
    <div>
        <h1>Workout App</h1>

        <Calendar></Calendar>

    </div>
</template>

<script>
import Calendar from "../components/calendar/Calendar";
import axios from "axios";

export default {
    name: "Main",
    components: {Calendar}
}
</script>

<style scoped>

</style>
