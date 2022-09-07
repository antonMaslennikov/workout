<template>
    <h1>Тренировочные планы</h1>

    <div class="row">
        <div class="col-sm-6">

            <div class="mb-3">
                <a href="#" class="btn btn-success" @click="showNewTrainingForm" v-if="!newTrainingShow">Новая тренировка</a>
            </div>

            <list
                :trainings="trainings"
                @editTraining="editTraining"
                @showNewActivitieForm="showNewActivitieForm"
                @showEditActivitieForm="showEditActivitieForm"
            ></list>
        </div>
        <div class="col-sm-6">
            <div class="mb-3 row" v-if="newTrainingShow">
                <NewTrainingForm
                    :training="currentTraining"
                    @addNewTraining="addNewTraining"
                    @updateTraining="updateTraining"
                    @hideNewTrainingForm="hideNewTrainingForm"
                ></NewTrainingForm>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import List from "../components/plans/List";
import NewTrainingForm from "../components/plans/NewTrainingForm";

export default {
    name: "PlansPage",
    components: {NewTrainingForm, List},
    data() {
        return {
            currentTraining: null,
            currentSet: null,
            currentActivitie: null,
            newTrainingShow: false,
            addActivitieForm: false,
        }
    },
    methods: {
        showNewTrainingForm() {
            // перемонтируем компонент
            this.newTrainingShow = false;

            this.$nextTick(() => {
                this.newTrainingShow = true;
                this.addActivitieForm = false;
                this.currentTraining = null;
                this.currentSet = null;
            });
        },
        hideNewTrainingForm() {
            this.newTrainingShow = false;
        },
        editTraining(training) {
            // перемонтируем компонент
            this.newTrainingShow = false;

            this.$nextTick(() => {
                this.currentTraining = training;
                this.addActivitieForm = false;
                this.newTrainingShow = true;
            });
        },
        addNewTraining(t) {
            this.newTrainingShow = false;
        },
        updateTraining() {
            this.newTrainingShow = false;
        },
    },
    mounted() {
        this.$store.dispatch('plans/fetch')
    },
    computed: {
        ...mapGetters({
            trainings: 'plans/list'
        }),
    },
}
</script>

<style scoped>

</style>
