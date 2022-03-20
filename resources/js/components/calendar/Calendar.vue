<template>
    <div class="calendar">

        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-dark" v-on:click="minusMonth"><i class="bi bi-arrow-left"></i> предыдущий месяц</button>
            </div>
            <div class="col-sm-2" v-bind:title="currentYear + '-' + currentMonth">
                Текущая дата: {{ currentYear }}-{{ currentMonthFormated }}
            </div>
            <div class="col-sm-2">
                <button class="btn btn-dark" @click="plusMonth">следующий месяц <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <div class="days-wrapper col-sm-5" v-if="!isCalendarLoading">
            <Day
                v-for="day in dates"
                :day="day"
                :key="day.id"
            ></Day>
        </div>
        <div v-else>Идёт загрузка</div>
    </div>
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
            ],
            // данные с запланнированными/проведёнными на выбранный период днями с тренировками
            activities: [],
            isCalendarLoading: true,
            dialogVisible: false,
            currentMonth: new Date().getMonth() + 1,
            currentYear: new Date().getFullYear(),
        }
    },
    methods: {
        async fetchCalendarDays() {
            try {
                this.isCalendarLoading = true;
                const response = await axios.get('/api/days?y=' + this.currentYear + '&m=' + this.currentMonth, {});
                this.activities = response.data;

                this.dates = [];

                let days = new Date(this.currentYear, this.currentMonth, 0).getDate();

                for (let i = 1; i <= days; i++) {
                    this.dates.push({id: i, day: i});
                }
            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isCalendarLoading = false;
            }
        },
        minusMonth() {
            this.currentMonth--;

            if (this.currentMonth < 1) {
                this.currentMonth = 12;
                this.currentYear--;
            }
        },
        plusMonth() {
            this.currentMonth++;

            if (this.currentMonth > 12) {
                this.currentMonth = 1;
                this.currentYear++;
            }
        }
    },
    mounted() {
        this.fetchCalendarDays();
    },
    computed: {
        currentMonthFormated() {
            return this.currentMonth < 10 ? '0' + this.currentMonth : this.currentMonth;
        }
    },
    watch: {
        currentMonth() {
            this.fetchCalendarDays();
        }
    }
}
</script>

<style scoped>
    .calendar {

    }
    .days-wrapper {
        margin-top: 30px;
    }
</style>
