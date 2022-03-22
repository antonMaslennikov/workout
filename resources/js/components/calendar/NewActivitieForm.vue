<template>
    <form @submit.prevent>
        <div class="mb-3">
            <label for="" class="form-label">Упражнение</label>
            <my-select
                v-model="form.activitie_id"
                :options="activities"
            ></my-select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Кол-во повторений</label>
            <my-input
                v-model="form.quantity"
            ></my-input>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Комментарий</label>
            <my-textarea
                v-model="form.comment"
            ></my-textarea>
        </div>


        <my-button @click="saveActivitie" class="btn-success">Создать</my-button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    name: "NewActivitieForm",
    components: {MyTextarea, MyInput},
    data() {
        return {
            isLoading: false,
            activities: [],
            form: {
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
                const response = await axios.get('/api/activities', {});

                response.data.forEach(i => {
                    this.activities.push({'name' : i.name, 'value' : i.id});
                });

            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isLoading = false;
            }
        },
    },
    mounted() {
        this.fetchActivities();
    }
}
</script>

<style scoped>

</style>
