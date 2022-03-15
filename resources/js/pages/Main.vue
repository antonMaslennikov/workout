<template>
    <div>
        <h1>Workout App</h1>

        <Calendar
            v-bind:dates="dates"
            v-if="!isCalendarLoading"
        ></Calendar>
        <div v-else>Идёт загрузка</div>
    </div>
</template>

<script>
import Calendar from "../components/calendar/Calendar";
import axios from "axios";

export default {
    name: "Main",
    components: {Calendar},
    data() {
        return {
            dates: [],
            isCalendarLoading: true,
            dialogVisible: false,
        }
    },
    methods: {
        async fetchCalendarDays() {
            try {
                this.isCalendarLoading = true;
                const response = await axios.get('/api/calendar', {});
                this.dates = response.data;
            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isCalendarLoading = false;
            }
        },
    },
    mounted() {
        this.fetchCalendarDays();
    },
}
</script>

<style scoped>

</style>
