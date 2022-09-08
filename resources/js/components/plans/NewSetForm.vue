<template>
    <form @submit.prevent>
        <h5>{{ form.id > 0 ? 'Редактировать сет' : 'Новый сет' }}</h5>

        <div class="mb-3">
            <label class="form-label">Количество подходов</label>
            <my-input v-model="form.quantity"></my-input>
        </div>

        <div class="mb-3">
            <label class="form-label">Комментарий</label>
            <my-textarea
                v-model="form.comment"
            ></my-textarea>
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
        set: {
            type: Object
        },
        training: {
            type: Object
        }
    },
    data() {
        return {
            form: {
                name: '',
                comment: '',
                training_id: '',
            },
        }
    },
    methods: {
        saveSet() {
            this.$store
                .dispatch('plans/saveSet', this.form, this.set)
                .then(res => {
                    if (!this.form.id) {
                        this.$emit('addNewSet', this.form);
                    } else {
                        this.$emit('editSet');
                    }
            });
        },
    },
    mounted() {
        if (this.set) {
            this.form.id = this.set.id;
            this.form.quantity = this.set.quantity;
            this.form.comment = this.set.comment;
        } else {
            this.form = {};
        }

        this.form.training_id = this.training.id;
    }
}
</script>

<style scoped>

</style>
