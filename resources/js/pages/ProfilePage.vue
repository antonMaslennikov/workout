<template>
    <div>
        <h1>Профиль</h1>

        <div v-if="isLoading">
            Данные загружаются
        </div>
        <div v-else>
            <p>
                <b>Имя:</b> &nbsp;
                <text-edit :text="profile.name" @save="saveName"></text-edit>
            </p>
            <p><b>Email:</b> &nbsp;
                <text-edit :text="profile.email" @save="saveEmail"></text-edit></p>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import TextEdit from "../components/UI/TextEdit";

export default {
    name: "ProfilePage",
    components: {TextEdit},
    methods: {
        ...mapActions({
            saveName: 'profile/saveName',
            saveEmail: 'profile/saveEmail',
        }),
    },
    mounted() {
        this.$store.dispatch('profile/fetchProfile');
    },
    computed: {
        ...mapGetters({
            isLoading: 'profile/isLoading',
            profile: 'profile/data'
        }),
    },
}
</script>

<style scoped>

</style>
