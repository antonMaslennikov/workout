<template>
    <form @submit.prevent>
        <h5>{{ form.id > 0 ? 'Редактировать сет' : 'Новый сет' }}</h5>

        <div class="mb-3">
            <label class="form-label">Количество подходов</label>
            <my-input v-model="form.quantity"></my-input>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <my-button class="btn-success me-2" @click="saveSet"><i class="bi bi-check-lg"></i> сохранить</my-button>
                </div>
                <div class="col-6 text-end">
                    <my-button class="btn-dark" @click="this.$emit('hideSetForm')"><i class="bi bi-x-lg"></i> отменить</my-button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import {mapActions} from "vuex";

export default {
    name: "new-set-form",
    components: {},
    props: {
        training: {
            type: Object
        }
    },
    data() {
        return {
            form: {
                name: '',
            },
        }
    },
    methods: {
        saveTraining() {
            this.$store
                .dispatch('plans/saveTraining', this.form)
                .then(res => {
                    if (!this.form.id) {
                        this.$emit('addNewTraining', this.form);
                    } else {
                        this.$emit('editTraining');
                    }
            });
        },

        clearForm() {
            this.form.id = 0;
            this.form.name = '';
        },
    },
    mounted() {
        if (this.training) {
            this.form.id = this.training.id;
            this.form.name = this.training.name;
        } else {
            this.clearForm();
        }
    }
}
</script>

<style scoped>

</style>
