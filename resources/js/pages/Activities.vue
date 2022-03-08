<template>
    <h1>Список упражнений</h1>

    <p>
        <my-button class="btn-success" @click="">Добавить</my-button>
    </p>

    <activities-list
        v-bind:activities="activities"
        v-if="!isLoading"
    />
    <div v-else>Идёт загрузка</div>
</template>

<script>
import ActivitiesList from "../components/activities/List";
import axios from "axios";
import MyButton from "../components/UI/MyButton";

export default {
    name: "Activities",
    components: {MyButton, ActivitiesList},
    data() {
        return {
            activities: [],
            isLoading: true,
        }
    },
    methods: {
        async fetchActivities() {
            try {
                this.isLoading = true;
                const response = await axios.get('/api/activities', {});
                this.activities = response.data;
            } catch (e) {
                alert('Ошибка');
            } finally {
                this.isLoading = false;
            }
        },
        openModal() {

        }
    },
    mounted() {
        this.fetchActivities();
    },
    computed: {
        activities() {
            return this.activities;
        }
    },
}
</script>

<style scoped>

</style>
