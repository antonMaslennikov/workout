<template>
    <div class="calendar" v-if="!isCalendarLoading">
        Тут будет смена месяцев взад-перёд {{ currentYear }}-{{ currentMonth }}

        <Day
            v-for="day in dates"
            :day="day"
            :key="day.id"
        ></Day>
    </div>
    <div v-else>Идёт загрузка</div>
</template>

<script>
import axios from "axios";
import Day from "./Day";

export default {
    name: "Calendar",
    components: {Day},
    data() {
        return {
            dates: [
                {id: 1, date: '01-03'},
                {id: 2, date: '02-03'},
                {id: 3, date: '03-03'},
            ],
            // данные с запланнированными/проведёнными на выбранный период днями с тренировками
            activities: [],
            isCalendarLoading: true,
            dialogVisible: false,
            currentMonth: '03',
            currentYear: '2022',
        }
    },
    methods: {
        async fetchCalendarDays() {
            try {
                this.isCalendarLoading = true;
                const response = await axios.get('/api/days', {});
                this.activities = response.data;
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
    .calendar {

    }
</style>
