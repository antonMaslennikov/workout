<template>
    <div class="calendar--day">
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

    .day {
        font-size: 30px;
        font-style: italic;
        font-weight: bold;
    }
</style>
