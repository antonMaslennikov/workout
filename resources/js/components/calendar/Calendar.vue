<template>
    <div class="calendar">

        <div class="calendar--navigation">
            <div>
                <button class="btn btn-dark" v-on:click="minusMonth"><i class="bi bi-arrow-left"></i> <span class="label">предыдущий месяц</span></button>
            </div>
            <div v-bind:title="currentYear + '-' + currentMonth">
                Текущая дата: <b>{{ currentMonthFormated }} {{ currentYear }}</b>
            </div>
            <div>
                <button class="btn btn-dark" @click="plusMonth"><span class="label">следующий месяц</span> <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <div class="days-wrapper">
            <div class="calendar--daysname">
                <div>ПН</div>
                <div>ВТ</div>
                <div>СР</div>
                <div>ЧТ</div>
                <div>ПТ</div>
                <div>СБ</div>
                <div>ВС</div>
            </div>
            <div v-if="!isCalendarLoading">
                <Day
                    v-for="day in fakeDates"
                    :day="day"
                    :key="day.id"
                    class="calendar--day hidden"
                ></Day>
                <Day
                    v-for="day in dates"
                    :day="day"
                    :key="day.id"
                    @showDayModal="openModal"
                    class="calendar--day"
                ></Day>
            </div>
            <div v-else class="callendar--loader">Идёт загрузка</div>
        </div>


        <my-dialog v-model:show="dialogVisible" class="-large">
            <day-view
                v-bind:year="currentYear"
                v-bind:month="currentMonth"
                v-bind:day="currentDay"
                @add-new-training="addNewTraining"
                @remove-training="removeTraining"
            >
            </day-view>
        </my-dialog>

<!--        <my-modal v-model:show="dialogVisible" id="day-modal">-->
<!--            222222-->
<!--        </my-modal>-->
    </div>
</template>

<script>
import axios from "axios";
import Day from "./Day";
import DayView from "./view/View";

export default {
    name: "Calendar",
    components: {DayView, Day},
    data() {
        return {
            // массив фейковых дней для заполнения календаря, если месяц начинается не с понедельника
            fakeDates: [],
            dates: [],
            // данные с запланнированными/проведёнными на выбранный период днями с тренировками
            activities: [],
            isCalendarLoading: true,
            dialogVisible: false,
            currentMonth: new Date().getMonth() + 1,
            currentYear: new Date().getFullYear(),
            currentDay: null,
            // myModal: new bootstrap.Modal(document.getElementById('#day-modal'), options),
        }
    },
    methods: {
        async fetchCalendarDays() {
            try {
                this.isCalendarLoading = true;

                const response = await axios.get(this.$store.state.api_url + '/days/' + this.currentYear + '/' + this.currentMonth, {});
                this.activities = response.data;

                this.dates = [];
                this.fakeDates = [];

                for (let i = 0; i < (new Date(this.currentYear, this.currentMonth - 1, 0).getDay()); i++) {
                    this.fakeDates.push({id: i, day: i});
                }

                for (let i = 1; i <= new Date(this.currentYear, this.currentMonth, 0).getDate(); i++) {
                    this.dates.push(
                        {
                            id: i,
                            day: i,
                            month: this.currentMonth,
                            year: this.currentYear
                        }
                    );

                    if (this.activities[i]) {
                        this.dates[i - 1].trainings = this.activities[i].trainings
                    }
                }

            } catch (e) {
                console.log(e);
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
        },
        openModal(day) {
            this.dialogVisible = true;
            this.currentDay = day;
        },
        closeModal() {
            this.dialogVisible = false;
            this.currentDay = null;
        },
        addNewTraining(t) {
            if (!this.dates[t.day- 1].trainings) {
                this.dates[t.day - 1].trainings = 0;
            }
            this.dates[t.day - 1].trainings++;
        },
        removeTraining(t) {
            this.dates[new Date(t.start_at).getDate() - 1].trainings--;
        }
    },
    mounted() {
        this.fetchCalendarDays();
    },
    computed: {
        currentMonthFormated() {
            // return this.currentMonth < 10 ? '0' + this.currentMonth : this.currentMonth;
            return this.$store.state.months[this.currentMonth - 1];
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
        max-width: 770px;
    }

    .calendar--navigation {
        display: flex;
        justify-content: space-between;
    }

    @media screen and (max-width: 600px) {
        .calendar--navigation .label {
            display: none;
        }
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

    .calendar--day {
        display: inline-block;
        border:1px solid black;
        border-radius: 3px;
        width:100px;
        height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
        padding: 5px 10px;
        cursor: pointer;
        vertical-align: middle;
    }

    .calendar--day.hidden {
        visibility: hidden;
    }

    .calendar--day.currentDay {
        background: #e1e1e1;
    }

    @media screen and (max-width: 810px) {
        .calendar {
        }
        .calendar--daysname div {
            width: calc(100% / 7 - 10px);
        }
        .calendar--day {
            width: calc(100% / 7 - 10px);
        }
    }

</style>
