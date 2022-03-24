<template>
    <div class="dayView--wrapper">
        <h4>{{ year }}-{{ month }}-{{ day }}</h4>
        <hr>
        <div class="row">
            <div class="col-sm-7">

                <div class="accordion mb-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Тренировка #1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Тренировка #2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <a href="#">Новая тренировка</a>
                </div>

                <div class="mb-3 row">
                    <div class="col-auto">
                    <my-input placeholder="название"></my-input>
                    </div>
                    <div class="col-auto">
                    <my-input placeholder="ЧЧ" size="2"></my-input>
                    </div>
                    <div class="col-auto">
                    <my-input placeholder="ММ" size="2"></my-input>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <NewActivitieForm ></NewActivitieForm>
            </div>
        </div>
    </div>
</template>

<script>
import NewActivitieForm from "./NewActivitieForm";
import MyInput from "../../UI/MyInput";
export default {
    name: "DayView",
    components: {MyInput, NewActivitieForm},
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
    max-width: 800px;
}
</style>
