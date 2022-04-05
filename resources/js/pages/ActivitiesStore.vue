<template>
    <h1>Список упражнений</h1>

    <p>
        <my-button class="btn-success" @click="openClearModal">Добавить</my-button>
    </p>

    <my-dialog v-model:show="dialogVisible">
        <activitie-form
            v-model:a="currentItem"
            @create="createActivitie1"
            @update="updateActivitie1"
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

        ...mapActions({
            fetchActivities: 'activitie/fetchActivities',
            createActivitie: 'activitie/createActivitie',
            updateActivitie: 'activitie/updateActivitie',
            removeActivitie: 'activitie/removeActivitie',
            saveSort: 'activitie/saveSort',
        }),

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
        createActivitie1(activitie) {
            this.createActivitie(activitie);
            this.closeModal();
        },
        updateActivitie1(activitie) {
            // this.$store.dispatch('updateActivitie', activitie);
            this.updateActivitie(activitie);
            this.closeModal();
        },
    },
    mounted() {
        this.$store.dispatch('activitie/setPage', this.$route.params.page[0] ?? 1);
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
