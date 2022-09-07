<template>
    <form @submit.prevent>
        <h5>{{ form.id > 0 ? 'Редактировать тренировку' : 'Новая тренировка' }}</h5>

        <div class="mb-3">
            <label class="form-label">Название тренировки</label>
            <my-input v-model="form.name"></my-input>
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
                    <my-button class="btn-success me-2" @click="saveTraining"><i class="bi bi-check-lg"></i> сохранить</my-button>
                </div>
                <div class="col-6 text-end">
                    <my-button class="btn-dark" @click="this.$emit('hideNewTrainingForm')"><i class="bi bi-x-lg"></i> отменить</my-button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: "new-training-form",
    components: {},
    props: {
        year: String,
        month: String,
        day: String,
        training: {
            type: Object
        }
    },
    data() {
        return {
            form: {
                year: this.year,
                month: this.month,
                day: this.day,
                name: '',
                hour: '',
                minute: '',
            },
        }
    },
    methods: {

        saveTraining() {
            this.$store.dispatch('trainings/saveTraining', this.form);
            this.clearForm();
            if (!this.form.id) {
                this.$emit('addNewTraining', this.form);
            } else {
                this.$emit('editTraining');
            }
        },

        clearForm() {
            this.form.id = 0;
            this.form.name = '';
            this.form.hour = '';
            this.form.minute = '';
        },
    },
    mounted() {
        if (this.training) {
            this.form.id = this.training.id;
            this.form.name = this.training.name;

            if (this.training.start_at) {
                let d = new Date(this.training.start_at);

                this.form.hour = d.getHours() ? d.getHours() : '';
                this.form.minute = d.getMinutes() ? d.getMinutes() : '';
            }
        } else {
            this.clearForm();
        }
    }
}
</script>

<style scoped>

</style>
