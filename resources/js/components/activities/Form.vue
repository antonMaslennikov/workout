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

        <my-button @click="saveActivitie" class="btn-success">Создать</my-button>
    </form>
</template>

<script>
export default {
    name: "ActivitieForm",
    components: {},
    props: {
        a: {
            type: Object,
        }
    },
    data() {
        return {
            aa: {
                id: '',
                name: '',
                description: '',
            }
        }
    },
    mounted() {
        if (this.a) {
            this.aa.id = this.a.id;
            this.aa.name = this.a.name;
            this.aa.description = this.a.description;
        } else {
            this.clearForm();
        }
    },
    methods: {
        saveActivitie() {
            if (!this.aa.id) {
                this.$emit('create', this.aa)
            } else {
                this.$emit('update', this.aa)
            }

            this.clearForm();
        },
        clearForm() {
            this.aa = {
                id: '',
                name: '',
                description: ''
            };
        }
    }
}
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
}
</style>
