<template>
    <h1>Тренировочные планы</h1>

    <div class="row">
        <div class="col-sm-6">
            <trainings-list
                :trainings="trainings"
            ></trainings-list>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import TrainingsList from "../components/TrainingsList";

export default {
    name: "PlansPage",
    components: {TrainingsList},
    data() {
        return {
        }
    },
    methods: {
        ...mapActions({
        }),
    },
    mounted() {
        this.$store.dispatch('trainings/fetchMy')
    },
    computed: {
        ...mapGetters({
            trainings: 'trainings/list'
        }),
    },
}
</script>

<style scoped>

</style>
