<template>
    <form @submit.prevent>
        <h4>Создание упражнения</h4>

        <br>

        <my-input
            placeholder="Название"
            v-model="aa.name"
        />

        <my-textarea
            placeholder="Описание"
            v-model="aa.description"
        />

        <my-button @click="createActivitie" class="btn-success">Создать</my-button>
    </form>
</template>

<script>
export default {
    name: "ActivitieForm",
    components: {},
    data() {
        return {
            aa: {
                name: '',
                description: '',
            }
        }
    },
    methods: {
        createActivitie() {
            this.$emit('create', this.aa)

            this.aa = {
                name: '',
                description: ''
            };
        },
    }
}
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
}
</style>
