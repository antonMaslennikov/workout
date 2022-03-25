<template>
    <div class="calendar--day" :class="dayClass" @click="$emit('showDayModal', day.day)">
        <span class="day">{{ day.day }}</span>
    </div>
</template>

<script>
export default {
    name: "Day",
    props: {
        day: {
            type: Object,
            required: true
        }
    },
    computed: {
        dayClass() {
            return this.day.day > 0 ? (this.day.year == new Date().getFullYear() && this.day.month == new Date().getMonth() + 1 && this.day.day == new Date().getDate() ? 'currentDay' : '') : 'hidden'
        }
    }
}
</script>

<style scoped>
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
    }

    .calendar--day.hidden {
        visibility: hidden;
    }

    .calendar--day.currentDay {
        background: #e1e1e1;
    }

    .day {
        font-size: 30px;
        font-style: italic;
        font-weight: bold;
    }
</style>
