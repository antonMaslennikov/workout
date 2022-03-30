<template>
    <h1>Список упражнений</h1>

    <p>
        <my-button class="btn-success" @click="openClearModal">Добавить</my-button>
    </p>

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
import axios from "axios";
import ActivitiesList from "../components/activities/List";
import ActivitieForm from "../components/activities/Form";
import { mapState, mapActions, mapGetters, mapMutations } from "vuex";

export default {
    name: "ActivitiesStore",
    components: {ActivitieForm, ActivitiesList},
    data() {
        return {
            dialogVisible: false,
            currentItem: null,
        }
    },
    methods: {
        openModal() {
            this.dialogVisible = true;
        },
        closeModal() {
            this.dialogVisible = false;
        },
        openClearModal() {
            this.currentItem = null;
            this.openModal();
        },
        editActivitie(activitie) {
            this.currentItem = activitie;
            this.openModal();
        },

        ...mapActions({
            fetchActivities: 'activitie/fetchActivities',
            createActivitie: 'activitie/createActivitie',
            updateActivitie: 'activitie/updateActivitie',
            removeActivitie: 'activitie/removeActivitie',
            saveSort: 'activitie/saveSort',
        }),
    },
    mounted() {
        this.fetchActivities();
    },
    computed: {
        ...mapGetters({
            activities: 'activitie/list'
        }),
    },
}
</script>

<style scoped>

</style>
