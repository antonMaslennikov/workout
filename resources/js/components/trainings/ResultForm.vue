<template>
    <div class="mb-3">
        <div>
            <small>Повторений</small>
            <my-input v-model="form.repeats"></my-input>
            <div class="text-danger">{{ $store.getters['training/resultRepeatsError'] }}</div>
        </div>
    </div>
    <div class="mb-3">
        <div>
            <small>Вес</small>
            <my-input v-model="form.weight"></my-input>
            <div class="text-danger">{{ $store.getters['training/resultWeightError'] }}</div>
        </div>
    </div>
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
        training_id: {
            type: Number,
            required: true
        },
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
                training_id: 0,
                activitie_id: 0,
                repeats: this.activitie.results.length > 0 ? this.activitie.results[this.activitie.results.length - 1].repeats : '',
                weight: this.activitie.results.length > 0 ? this.activitie.results[this.activitie.results.length - 1].weight : '',
            }
        }
    },
    methods: {
        save() {

            this.form.training_id = this.training_id
            this.form.activitie_id = this.activitie.id

            this.saving = true

            this.$store
                .dispatch('training/saveResults', this.form)
                .then(res => {
                    this.saved = true;
                    this.saving = false;
                    setTimeout(() => {
                        this.$emit('savedSuccess', this.form);
                        }, 1000)
                })
                .catch(err => {
                    this.saving = false;
                })
            ;
        }
    },
    mounted() {
        this.$store.commit('training/saveResultsError', null);
    }
}
</script>

<style scoped>

</style>
