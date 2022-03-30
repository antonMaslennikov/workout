<template>
    <h1>Список упражнений</h1>

    <div class="row mb-3">
        <div class="col-10">
            <my-button class="btn-success" @click="openClearModal">Добавить</my-button>
        </div>
        <div class="col-2 text-end">
            <my-input placeholder="Поиск" v-model="searchQuery"></my-input>
        </div>
    </div>

    <my-dialog v-model:show="dialogVisible">
        <activitie-form
            v-model:a="currentItem"
            @create="createActivitie"
            @update="updateActivitie"
        />
    </my-dialog>

    <activities-list
        v-bind:activities="activities"
        @remove="removeActivitie"
        @edit="editActivitie"
        @saveSort="saveSort"
        v-if="!isLoading"
    />
    <div v-else>Идёт загрузка</div>
</template>

<script>
import ActivitiesList from "../components/activities/List";
import ActivitieForm from "../components/activities/Form";
import {useActivities} from "../hooks/activities/useActivities";
import axios from "axios";

export default {
    name: "ActivitiesComposition",
    components: { ActivitieForm, ActivitiesList},
    data() {
        return {
            dialogVisible: false,
            currentItem: null,
            searchQuery: '111',
        }
    },
    setup(props) {

        const {activities, isLoading} = useActivities(1, 5);

        return {
            activities,
            isLoading
        }
    },
    methods: {
        openModal() {
            this.dialogVisible = true;
        },
        closeModal() {
            this.dialogVisible = false;
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
                        this.closeModal();
                    }
                });
        },
        updateActivitie(activitie) {
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
        saveSort(order) {
            axios
                .post('/api/activities/savesort', {'order' : order})
                .then(response => {
                });
        },
        openClearModal() {
            this.currentItem = null;
            this.openModal();
        },
        editActivitie(activitie) {
            this.currentItem = activitie;
            this.openModal();
        },
    },
}
</script>

<style scoped>

</style>
