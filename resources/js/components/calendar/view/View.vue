<template>
    <div class="dayView--wrapper">
        <h4>{{ year }}-{{ month }}-{{ day }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-7">

                <div class="accordion mb-3" id="accordionExample">

                    <div class="accordion-item"
                         v-for="training in trainings"
                         :key="training.id"
                    >
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="true" v-bind:aria-controls="'collapse' + training.id" v-bind:data-bs-target="'#collapse' + training.id">
                                Тренировка #{{ training.id }}
                            </button>
                        </h2>
<!--                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">-->
                        <div v-bind:id="'collapse' + training.id" class="accordion-collapse collapse" v-bind:aria-labelledby="'heading' + training.id" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <a href="#" @click="newTrainingShow = !newTrainingShow">Новая тренировка</a>
                </div>

                <div class="mb-3 row" v-if="newTrainingShow">
                    <div class="col-auto">
                        <my-input placeholder="название"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-input placeholder="ЧЧ" size="2"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-input placeholder="ММ" size="2"></my-input>
                    </div>
                    <div class="col-auto">
                        <my-button class="btn-dark"><i class="bi bi-check-lg"></i></my-button>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <NewActivitieForm v-if="false"></NewActivitieForm>
            </div>
        </div>
    </div>
</template>

<script>
import NewActivitieForm from "./NewActivitieForm";
import MyInput from "../../UI/MyInput";
import MyButton from "../../UI/MyButton";
export default {
    name: "DayView",
    components: {MyButton, MyInput, NewActivitieForm},
    data() {
        return {
            newTrainingShow: false,
            trainings: [
                {id:1},
                {id:2},
                {id:3},
                {id:4},
            ],
        }
    },
    props: {
        year: {
            type: Number,
            required: true
        },
        month: {
            type: Number,
            required: true
        },
        day: {
            type: Number,
            required: true
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.dayView--wrapper {
    max-width: 900px;
}
</style>
