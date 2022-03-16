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

</style>
