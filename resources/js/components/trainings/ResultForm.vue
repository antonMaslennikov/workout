<template>
    <p>
        <label>
            <small>Повторений</small>
            <my-input v-model="form.repeats"></my-input>
        </label>
    </p>
    <p>
        <label>
            <small>Максимальный вес</small>
            <my-input v-model="form.weight"></my-input>
        </label>
    </p>
    <p>
        <button class="btn btn-success" @click="save()">Сохранить</button>
    </p>
</template>

<script>
import MyInput from "../UI/MyInput";
export default {
    name: "ResultForm",
    components: {MyInput},
    props: {
        activitie: {
            type: Object,
            required: true
        },

    },
    data() {
        return {
            form: {
                activitie_id: 0,
                repeats: '',
                weight: '',
            }
        }
    },
    methods: {
        save() {

            this.form.activitie_id = this.activitie.id

            this.$store
                .dispatch('trainings/saveResults', this.form)
                .then(res => {
                    if (!this.form.id) {
                        this.$emit('addNewTraining', this.form);
                    } else {
                        this.$emit('editTraining');
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
