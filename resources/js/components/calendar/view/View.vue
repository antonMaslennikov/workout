<template>
    <div class="dayView--wrapper">
        <h4>{{ currentDateFormated }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6">

                <trainings-list
                    :trainings="trainings"
                    @showNewActivitieForm=showNewActivitieForm
                    @showEditActivitieForm=showEditActivitieForm
                    @editTraining=editTraining
                ></trainings-list>

                <div class="mb-3">
                    <a href="#" @click="showNewTrainingForm" v-if="!newTrainingShow">Новая тренировка</a>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="mb-3 row" v-if="newTrainingShow">
                    <h5>{{ newTrainingForm.id > 0 ? 'Редактировать тренировку' : 'Новая тренировка' }}</h5>
                    <div class="mb-3">
                        <label class="form-label">Название тренировки</label>
                        <my-input v-model="newTrainingForm.name"></my-input>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Время проведения</label>
                        <div>
                            <my-input placeholder="ЧЧ" size="2" class="time-input" v-model="newTrainingForm.hour"></my-input>
                            :
                            <my-input placeholder="ММ" size="2" class="time-input" v-model="newTrainingForm.minute"></my-input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <my-button class="btn-success me-2" @click="saveTraining"><i class="bi bi-check-lg"></i> сохранить</my-button>
                            </div>
                            <div class="col-6 text-end">
                                <my-button class="btn-dark" @click="hideNewTrainingForm"><i class="bi bi-x-lg"></i> отменить</my-button>
                            </div>
                        </div>
                    </div>
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
import NewActivitieForm from "./NewActivitieForm";
import axios from "axios";
import TrainingsList from "../../TrainingsList";
import {mapGetters} from "vuex";
export default {
    name: "day-view",
    components: {TrainingsList, NewActivitieForm},
    data() {
        return {
            currentSet: null,
            currentActivitie: null,
            newTrainingShow: false,
            newTrainingForm: {
                year: this.year,
                month: this.month,
                day: this.day,
                name: '',
                hour: '',
                minute: '',
            },
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
            this.newTrainingShow = true;
            this.addActivitieForm = false;
            this.currentSet = null;
            if (this.newTrainingForm.id > 0) {
                this.clearTrainingForm();
            }
        },
        hideNewTrainingForm() {
            this.newTrainingShow = false;
            if (this.newTrainingForm.id > 0) {
                this.clearTrainingForm();
            }
        },
        clearTrainingForm() {
            this.newTrainingForm.id = 0;
            this.newTrainingForm.name = '';
            this.newTrainingForm.hour = '';
            this.newTrainingForm.minute = '';
        },
        saveTraining() {
            if (!this.newTrainingForm.id || this.newTrainingForm.id == 0) {
                axios
                    .post('/api/v1/trainings', this.newTrainingForm, {
                        headers: {
                            'Content-type': 'application/json'
                        }
                    })
                    .then(res => {
                        if (res.data.status == 'ok') {
                            let t = {};
                            Object.assign(t, this.newTrainingForm);
                            t.id = res.data.t.id;
                            t.start_at = res.data.t.start_at;
                            this.trainings.push(t);
                            this.newTrainingShow = false;
                            this.clearTrainingForm();
                            this.$emit('addNewTraining', t);
                        }
                    });
            } else {

                this.newTrainingForm._method = 'PUT';

                axios
                    .post('/api/v1/trainings/' + this.newTrainingForm.id, this.newTrainingForm)
                    .then(res => {
                        if (res.data.status == 'ok') {

                            this.trainings = this.trainings.map(item => {
                                if (item.id == this.newTrainingForm.id) {
                                    item.name = this.newTrainingForm.name;
                                    item.hour = this.newTrainingForm.hour;
                                    item.minute = this.newTrainingForm.minute;
                                    item.start_at = res.data.a.start_at;
                                }
                                return item;
                            });

                        }
                    });
            }
        },
        editTraining(training) {
            this.newTrainingForm.id = training.id;
            this.newTrainingForm.name = training.name;

            if (training.start_at) {
                let d = new Date(training.start_at);

                this.newTrainingForm.hour = d.getHours() ? d.getHours() : '';
                this.newTrainingForm.minute = d.getMinutes() ? d.getMinutes() : '';
            }

            this.addActivitieForm = false;
            this.newTrainingShow = true;
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
