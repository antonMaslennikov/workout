<template>
    <div class="accordion mb-3" id="accordionExample" v-if="!isTrainingsLoading">

        <div class="accordion-item"
             v-for="(training, index) in trainings"
             :key="training.id"
        >
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="true" v-bind:aria-controls="'collapse' + training.id" v-bind:data-bs-target="'#collapse' + training.id">
                    <div class="row" style="width: 90%">
                        <div class="col-10">
                            {{ training.name ? training.name : 'Тренировка #' + (index + 1) }}
                            {{ training.hour && training.hour !== '00' ? '(' + training.hour + ':' + (training.minute == '' ? '00' : training.minute)  + ')' : '' }}
                        </div>
                        <div class="col-2 -actions">
                            <a href="#" @click.stop.prevent="editTraining(training)" style="margin-right: 10px;"><i class="bi bi-pen"></i></a>
                            <a href="#" @click.stop.prevent="removeTraining(training)"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </button>
            </h2>
            <div v-bind:id="'collapse' + training.id" class="accordion-collapse collapse" v-bind:aria-labelledby="'heading' + training.id" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="training-sets--list">
                        <div v-for="(set, set_index) in training.sets">
                            Сет: {{ set_index + 1 }}.
                            <a href="#" @click="showNewActivitieForm(set)" v-if="!currentSet || set.id != currentSet.id"><i class="bi bi-plus-circle"></i></a>
                            &nbsp;
                            <a href="#" @click="removeSet(set)"><i class="bi bi-trash"></i></a>

                            <div class="training-activities--list ps-3">
                                <div v-for="(activitie, a_index) in set.activities">
                                    {{ a_index + 1 }}: {{ activitie.activitie.name }} ({{ activitie.quantity }} раз) {{ activitie.comment }}
                                    <a href="#" @click="showEditActivitieForm(set, activitie)" style="margin-right: 10px;"><i class="bi bi-pen"></i></a>
                                    <a href="#" @click="removeActivitie(activitie)"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="#" @click="addSet(training)">Добавить сет</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div v-else>Тренировки загружаются</div>
</template>

<script>
export default {
    name: "TrainingsList",
    props: {
        trainings: {
            type: Object
        }
    },
    methods: {
        addSet(training) {
            this.$emit('addSet', training);
        },
        removeSet(set) {
            this.$emit('removeSet', set);
        },
        showEditActivitieForm(set, activitie) {
            this.$emit('showEditActivitieForm', set, activitie);
        },
        removeActivitie(activitie) {
            this.$emit('removeActivitie', activitie);
        },
        showNewActivitieForm(set) {
            this.$emit('showNewActivitieForm', set);
        },
        editTraining(training) {
            this.$emit('editTraining', training);
        },
        removeTraining(training) {
            this.$emit('removeTraining', training);
        }
    }
}
</script>

<style scoped>

</style>
