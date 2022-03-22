<template>
    пум-пурум {{ year }} {{ month }} {{ day }}
</template>

<script>
export default {
    name: "DayView",
    props: {
        year: {
            type: Number,
            required: true
        },
        month: {
            type: Number,
            required: true
        },
        day: {
            type: Number,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
