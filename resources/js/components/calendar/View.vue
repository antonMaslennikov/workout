<template>
    <div class="dayView--wrapper">
        <h4>{{ currentDateFormated }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6">

                <list
                    :trainings="trainings"
                    @showNewActivitieForm=showNewActivitieForm
                    @showEditActivitieForm=showEditActivitieForm
                    @editTraining=editTraining
                ></list>

                <div class="mb-3">
                    <a href="#" @click="showNewTrainingForm" v-if="!newTrainingShow">Новая тренировка</a>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="mb-3 row" v-if="newTrainingShow">
                    <NewTrainingForm
                        :year="year"
                        :month="month"
                        :day="day"
                        :training="currentTraining"
                        @addNewTraining="addNewTraining"
                        @updateTraining="updateTraining"
                        @hideNewTrainingForm="hideNewTrainingForm"
                    ></NewTrainingForm>
                </div>

                <template v-if="addActivitieForm">
                    <NewActivitieForm
                        :set="currentSet"
                        :activitie="currentActivitie"
                        @hideNewActivitieForm="hideNewActivitieForm"
                    ></NewActivitieForm>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import NewActivitieForm from "../trainings/NewActivitieForm";
import NewTrainingForm from "../trainings/NewTrainingForm";
import axios from "axios";
import List from "../trainings/List";
import {mapGetters} from "vuex";
export default {
    name: "day-view",
    components: {List, NewActivitieForm, NewTrainingForm},
    data() {
        return {
            currentSet: null,
            currentActivitie: null,
            currentTraining: null,
            newTrainingShow: false,
            addActivitieForm: false,
        }
    },
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
            this.$emit('addNewTraining', t);
            this.newTrainingShow = false;
        },
        updateTraining() {
            this.newTrainingShow = false;
        },
        showNewActivitieForm(set) {

            // перемонтируем компонент
            this.addActivitieForm = false;

            this.$nextTick(() => {
                this.currentSet = set;
                this.addActivitieForm = true;
                this.newTrainingShow = false;
            });
        },
        showEditActivitieForm(set, activitie) {

            // перемонтируем компонент
            this.addActivitieForm = false;

            this.$nextTick(() => {
                this.currentSet = set;
                this.currentActivitie = activitie;
                this.addActivitieForm = true;
                this.newTrainingShow = false;
            });
        },
        hideNewActivitieForm() {
            this.currentSet = null;
            this.currentActivitie = null;
            this.addActivitieForm = false;
        },

    },
    mounted() {
        this.$store.commit('trainings/setYear', this.year);
        this.$store.commit('trainings/setMonth', this.month);
        this.$store.commit('trainings/setDay', this.day);

        this.$store.dispatch('trainings/fetch')
    },
    computed: {
        currentDateFormated() {
            return this.day + ' ' + this.$store.state.months[this.month - 1] + ', ' + this.year;
        },
        ...mapGetters({
            trainings: 'trainings/list'
        }),
    },
}
</script>

<style scoped>
.dayView--wrapper {
    max-width: 1000px;
}

#accordionExample .accordion-item .-actions {
    display: none;
    z-index: 9999999;
}

#accordionExample .accordion-item:hover .-actions {
    display: flex;
}

.accordion-body {
    background: #fff;
}
</style>
