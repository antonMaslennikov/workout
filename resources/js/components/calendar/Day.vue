<template>
    <div class="calendar--day">
        Один день {{ day.date }}
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
        box-sizing: border-box;
        padding: 10px;
        cursor: pointer;
    }
</style>
