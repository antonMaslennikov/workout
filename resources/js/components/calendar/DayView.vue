<template>
    <h4>{{ year }}-{{ month }}-{{ day }}</h4>
    <hr>
    <div class="row">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">

        </div>
    </div>
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
    mounted() {

    }
}
</script>

<style scoped>

</style>
