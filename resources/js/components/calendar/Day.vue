<template>
    <div class="calendar--day" :class="dayClass">
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
            return this.day.day > 0 ? '' : 'hidden'
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

    .day {
        font-size: 30px;
        font-style: italic;
        font-weight: bold;
    }
</style>
