<template>
    <form @submit.prevent>
        <h5>Добавить упражнение</h5>
        <div class="mb-3">
            <label class="form-label">Упражнение</label>
            <my-select
                v-model="form.activitie_id"
                :options="activities"
            ></my-select>
        </div>

        <div class="mb-3">
            <label class="form-label">Кол-во повторений</label>
            <my-input
                v-model="form.quantity"
            ></my-input>
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
                    <my-button class="btn-success me-2" @click="saveActivitie"><i class="bi bi-check-lg"></i> сохранить</my-button>
                </div>
                <div class="col-6 text-end">
                    <my-button class="btn-dark" @click="$emit('hideNewActivitieForm')"><i class="bi bi-x-lg"></i> отменить</my-button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "new-activitie-form",
    components: {},
    props: {
        set: {
            type: Object
        },
        activitie: {
            type: Object
        }
    },
    data() {
        return {
            isLoading: false,
            activities: [],
            form: {
                id: 0,
                activitie_id: 0,
                quantity: 1,
                comment: '',
            }
        }
    },
    methods: {
        async fetchActivities() {
            try {
                this.isLoading = true;
                const response = await axios.get('/api/v1/activities/all', {});

                response.data.forEach(i => {
                    this.activities.push({'name' : i.name, 'value' : i.id});
                });

            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isLoading = false;
            }
        },
        saveActivitie() {
            if (!this.form.id) {
                this.$emit('saveNewActivitie', this.form);
            } else {
                this.$emit('updateActivitie', this.form)
            }

            this.clearForm();
        },
        clearForm() {
            this.aa = {
                id: '',
                activitie_id: '',
                quantity: '',
                comment: ''
            };
        }
    },
    mounted() {
        this.fetchActivities();
        if (this.activitie) {
            this.form.id = this.activitie.id;
            this.form.activitie_id = this.activitie.activitie_id;
            this.form.quantity = this.activitie.quantity;
            this.form.comment = this.activitie.comment;
        } else {
            this.clearForm();
        }
    }
}
</script>

<style scoped>

</style>
