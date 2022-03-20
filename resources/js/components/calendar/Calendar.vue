<template>
    <div class="calendar">

        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-dark" v-on:click="minusMonth"><i class="bi bi-arrow-left"></i> предыдущий месяц</button>
            </div>
            <div class="col-sm-2" v-bind:title="currentYear + '-' + currentMonth">
                Текущая дата: <b>{{ currentMonthFormated }} {{ currentYear }}</b>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-dark" @click="plusMonth">следующий месяц <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <div class="days-wrapper col-sm-5">
            <div v-if="!isCalendarLoading">
                <div class="calendar--daysname">
                    <div>ПН</div>
                    <div>ВТ</div>
                    <div>СР</div>
                    <div>ЧТ</div>
                    <div>ПТ</div>
                    <div>СБ</div>
                    <div>ВС</div>
                </div>
                <Day
                    v-for="day in dates"
                    :day="day"
                    :key="day.id"
                ></Day>
            </div>
            <div v-else class="callendar--loader">Идёт загрузка</div>
        </div>
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
            months: [
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь',
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
                const response = await axios.get('/api/days/' + this.currentYear + '/' + this.currentMonth, {});
                this.activities = response.data;

                this.dates = [];

                for (let i = -1 * (new Date(this.currentYear, this.currentMonth - 1, 1).getDay()) + 1; i < 0; i++) {
                    this.dates.push({id: i, day: i});
                }

                for (let i = 1; i <= new Date(this.currentYear, this.currentMonth, 0).getDate(); i++) {
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
            // return this.currentMonth < 10 ? '0' + this.currentMonth : this.currentMonth;
            return this.months[this.currentMonth - 1];
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

    .callendar--loader {
        text-align: center;
        padding: 100px 0;
    }

    .calendar--daysname div {
        display: inline-block;
        width:100px;
        margin-right: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
        padding: 5px 10px;
        color: #fff;
        background-color: #212529;
        border:1px solid #212529;
        text-align: center;
    }
</style>
