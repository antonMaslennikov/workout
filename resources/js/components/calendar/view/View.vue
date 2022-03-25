<template>
    <div class="dayView--wrapper">
        <h4>{{ currentDateFormated }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-7">

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
                                        <a href="#" style="margin-right: 10px"><i class="bi bi-pen"></i></a>
                                        <a href="#" @click="removeTraining(training.id)"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div v-bind:id="'collapse' + training.id" class="accordion-collapse collapse" v-bind:aria-labelledby="'heading' + training.id" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{ training.start_at }}
                            </div>
                        </div>
                    </div>

                </div>
                <div v-else>Тренировки загружаются</div>

                <div class="mb-3">
                    <a href="#" @click="newTrainingShow = !newTrainingShow">Новая тренировка</a>
                </div>

                <div class="mb-3 row" v-if="newTrainingShow">
                    <div class="col-auto">
                        <my-input placeholder="название" v-model="newTrainingForm.name"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-input placeholder="ЧЧ" size="2" v-model="newTrainingForm.hour"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-input placeholder="ММ" size="2" v-model="newTrainingForm.minute"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-button class="btn-dark" @click="saveTraining"><i class="bi bi-check-lg"></i></my-button>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
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
        clearTrainingForm() {
            this.newTrainingForm.name = '';
            this.newTrainingForm.hour = '';
            this.newTrainingForm.minute = '';
        },
        saveTraining() {
            axios
                .post('/api/trainings', this.newTrainingForm, {
                    headers: {
                        'Content-type':'application/json'
                    }
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        let t = this.newTrainingForm;
                        t.id = res.data.t.id;
                        t.start_at = res.data.t.start_at;
                        this.trainings.push(t);
                        this.newTrainingShow = false;
                        this.clearTrainingForm();
                    }
                });
        },
        /*
        updateTraining() {
            axios
                .post('/api/activities/' + activitie.id, {
                    name : activitie.name,
                    description : activitie.description,
                    body_part : activitie.body_part,
                    _method: 'PUT'
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        this.activities = this.activities.map(item => {
                            if (item.id == activitie.id) {
                                return activitie;
                            } else {
                                return item;
                            }
                        });
                        this.closeModal();
                    }
                });
        },
         */
        removeTraining(training) {
            if (confirm('Подтверждаете удаление?')) {
                axios
                    .post('/api/activities/' + activitie.id, {
                        _method: 'DELETE'
                    })
                    .then(response => {
                        this.activities = this.activities.filter(a => a.id !== activitie.id)
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
    max-width: 900px;
}

#accordionExample .accordion-item .-actions {
    display: none;
}

#accordionExample .accordion-item:hover .-actions {
    display: flex;
}

.accordion-body {
    background: #fff;
}
</style>
