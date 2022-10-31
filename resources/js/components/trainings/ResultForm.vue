<template>
    <p>
        <label>
            <small>Повторений</small>
            <my-input v-model="form.repeats"></my-input>
        </label>
    </p>
    <p>
        <label>
            <small>Вес</small>
            <my-input v-model="form.weight"></my-input>
        </label>
    </p>
    <p>
        <button class="btn btn-primary" v-if="!saving && !saved" @click="save()">Сохранить</button>
        <button class="btn btn-primary" v-if="saving && !saved">Сохраняется</button>
        <button class="btn btn-success" v-if="!saving && saved">Сохранено</button>
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
            saving:false,
            saved:false,
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

            this.saving = true

            this.$store
                .dispatch('trainings/saveResults', this.form)
                .then(res => {
                    this.saved = true;
                    this.saving = false;
                    setTimeout(() => {
                        this.$emit('savedSuccess', this.form);
                        }, 1000)
                });
        }
    }
}
</script>

<style scoped>

</style>
