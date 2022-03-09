<template>
    <h1>Список упражнений</h1>

    <p>
        <my-button class="btn-success" @click="openModal">Добавить</my-button>
    </p>

    <my-dialog v-model:show="dialogVisible">
        <activitie-form @create="createActivitie" />
    </my-dialog>

    <activities-list
        v-bind:activities="activities"
        @remove="removeActivitie"
        v-if="!isLoading"
    />
    <div v-else>Идёт загрузка</div>
</template>

<script>
import axios from "axios";
import ActivitiesList from "../components/activities/List";
import ActivitieForm from "../components/activities/Form";

export default {
    name: "Activities",
    components: {ActivitieForm, ActivitiesList},
    data() {
        return {
            activities: [],
            isLoading: true,
            dialogVisible: false,
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
            this.dialogVisible = true;
        },
        createActivitie(activitie) {
            axios
                .post('/api/activities', activitie, {
                    headers: {
                        'Content-type':'application/json'
                    }
                })
                .then(res => {
                    if (res.data.status == 'ok') {
                        activitie.id = res.data.a.id;
                        this.activities.push(activitie);
                        this.dialogVisible = false;
                    }
                });
        },
        removeActivitie(activitie) {
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
