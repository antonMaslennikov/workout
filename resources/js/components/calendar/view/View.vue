<template>
    <div class="dayView--wrapper">
        <h4>{{ currentDateFormated }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6">

                <div class="accordion mb-3" id="accordionExample" v-if="!isTrainingsLoading">

                    <div class="accordion-item"
                         v-for="(training, index) in trainings"
                         :key="training.id"
                    >
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="true" v-bind:aria-controls="'collapse' + training.id" v-bind:data-bs-target="'#collapse' + training.id">
                                <div class="row" style="width: 90%">
                                    <div class="col-10">{{ training.name ? training.name : 'Тренировка #' + (index + 1) }}</div>
                                    <div class="col-2 -actions">
                                        <a href="#" @click.stop.prevent="editTraining(training)" style="margin-right: 10px;"><i class="bi bi-pen"></i></a>
                                        <a href="#" @click.stop.prevent="removeTraining(training)"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div v-bind:id="'collapse' + training.id" class="accordion-collapse collapse" v-bind:aria-labelledby="'heading' + training.id" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ training.start_at }}
                                <div class="training-sets--list"
                                     v-for="(set, set_index) in training.sets">
                                    Сет: {{ set_index + 1 }}

                                    <div class="training-activities--list"
                                         v-for="(activitie, a_index) in set.activities">
                                        Упражнение: {{ a_index + 1 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div v-else>Тренировки загружаются</div>

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
                        <my-button class="btn-success me-2" @click="saveTraining"><i class="bi bi-check-lg"></i> сохранить</my-button>
                        <my-button class="btn-dark" @click="hideNewTrainingForm"><i class="bi bi-x-lg"></i> отменить</my-button>
                    </div>
                </div>

                <NewActivitieForm v-if="false"></NewActivitieForm>
            </div>
        </div>
    </div>
</template>

<script>
import NewActivitieForm from "./NewActivitieForm";
import axios from "axios";
export default {
    name: "DayView",
    components: {NewActivitieForm},
    data() {
        return {
            isTrainingsLoading: false,
            newTrainingShow: false,
            newTrainingForm: {
                year: this.year,
                month: this.month,
                day: this.day,
                name: '',
                hour: '',
                minute: '',
            },
            trainings: [
            ],
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
        async fetchTrainings() {
            try {
                this.isTrainingsLoading = true;
                const response = await axios.get('/api/trainings/' + this.year + '/' + this.month + '/' + this.day, {});
                this.trainings = response.data;
            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isTrainingsLoading = false;
            }
        },
        showNewTrainingForm() {
            this.newTrainingShow = true;
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
            if (!this.newTrainingForm.id) {
                axios
                    .post('/api/trainings', this.newTrainingForm, {
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

                        }
                    });
            } else {

                this.newTrainingForm._method = 'PUT';
                console.log(this.newTrainingForm);

                axios
                    .post('/api/trainings/' + this.newTrainingForm.id, this.newTrainingForm)
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

            this.newTrainingShow = true;
        },
        removeTraining(training) {
            if (confirm('Подтверждаете удаление?')) {
                axios
                    .post('/api/trainings/' + training.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        this.trainings = this.trainings.filter(a => a.id !== training.id)
                    });
            }
        },
    },
    mounted() {
        this.fetchTrainings();
    },
    computed: {
        currentDateFormated() {
            return this.day + ' ' + this.$store.state.months[this.month - 1] + ', ' + this.year;
        }
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
