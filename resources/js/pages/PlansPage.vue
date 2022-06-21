<template>
    <h1>Тренировочные планы</h1>

    <div class="row">
        <div class="col-sm-6">
            <trainings-list
                :trainings="trainings"
                :isTrainingsLoading="isTrainingsLoading"
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
            isTrainingsLoading: false,
        }
    },
    methods: {
        ...mapActions({
            // fetchTrainings: 'trainings/fetch',
            // createActivitie: 'activitie/createActivitie',
            // updateActivitie: 'activitie/updateActivitie',
            // removeActivitie: 'activitie/removeActivitie',
        }),
    },
    mounted() {
        this.$store.dispatch('trainings/fetch')
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
