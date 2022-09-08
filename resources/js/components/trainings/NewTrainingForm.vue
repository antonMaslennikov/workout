<template>
    <form @submit.prevent>
        <h5>{{ form.id > 0 ? 'Редактировать тренировку' : 'Новая тренировка' }}</h5>

        <div class="mb-3">
            <label class="form-label">Выберите тренировку</label>
            <my-select
                v-model="form.training_id"
                :options="trainings"
            ></my-select>
        </div>

        <div class="mb-3">
            <label class="form-label">Время проведения</label>
            <div>
                <my-input placeholder="ЧЧ" size="2" class="time-input" v-model="form.hour"></my-input>
                :
                <my-input placeholder="ММ" size="2" class="time-input" v-model="form.minute"></my-input>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <my-button class="btn-success me-2" @click="saveTraining"><i class="bi bi-check-lg"></i> сохранить
                    </my-button>
                </div>
                <div class="col-6 text-end">
                    <my-button class="btn-dark" @click="this.$emit('hideNewTrainingForm')"><i class="bi bi-x-lg"></i>
                        отменить
                    </my-button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import {mapActions, mapGetters} from "vuex";
import MySelect from "../UI/MySelect";

export default {
    name: "new-training-form",
    components: {MySelect},
    props: {
        year: {
            type: String,
            required: true
        },
        month: {
            type: String,
            required: true
        },
        day: {
            type: String,
            required: true
        },
        training: {
            type: Object
        }
    },
    data() {
        return {
            trainings: [],
            form: {
                year: this.year,
                month: this.month,
                day: this.day,
                training_id: 0,
                name: '',
                hour: '',
                minute: '',
            },
        }
    },
    methods: {
        saveTraining() {
            this.$store
                .dispatch('trainings/saveTraining', this.form)
                .then(res => {
                    if (!this.form.id) {
                        this.$emit('addNewTraining', this.form);
                    } else {
                        this.$emit('editTraining');
                    }
                });
        },
        async fetchTrainings() {
            try {
                const response = await axios.get('/api/v1/plans/all', {});

                response.data.forEach(i => {
                    this.trainings.push({'name': i.name, 'value': i.id});
                });

            } catch (e) {
                alert('Ошибка');
            } finally {
            }
        },
    },
    mounted() {

        this.fetchTrainings();

        if (this.training) {
            this.form.id = this.training.id;
            this.form.training_id = this.training.training.id;

            if (this.training.start_at) {
                let d = new Date(this.training.start_at);

                this.form.hour = d.getHours() ? d.getHours() : '';
                this.form.minute = d.getMinutes() ? d.getMinutes() : '';
            }
        } else {
            this.form.id = 0;
            this.form.training_id = 0;
            this.form.hour = '';
            this.form.minute = '';
        }
    },
    computed: {}
}
</script>

<style scoped>

</style>
