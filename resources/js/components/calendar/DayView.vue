<template>
    <h4>{{ year }}-{{ month }}-{{ day }}</h4>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div>Тренировка 1</div>
            <div>Тренировка 2</div>
            <div><button class="btn btn-success">Новая тренировка</button></div>
        </div>
        <div class="col-sm-6">
            <NewActivitieForm ></NewActivitieForm>
        </div>
    </div>
</template>

<script>
import NewActivitieForm from "./NewActivitieForm";
export default {
    name: "DayView",
    components: {NewActivitieForm},
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
