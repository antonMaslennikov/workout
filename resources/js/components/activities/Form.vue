<template>
    <form @submit.prevent>
        <h4>Создание упражнения</h4>

        <br>

        <div class="mb-3">
            <label for="" class="form-label">Название</label>
            <my-input
                placeholder="Название"
                v-model="aa.name"
            />
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Часть тела</label>
            <my-select
                v-model="aa.body_part"
                :options="bodyParts">
            </my-select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Комментарий</label>
            <my-textarea
                placeholder="Описание"
                v-model="aa.description"
            />
        </div>

        <my-button @click="saveActivitie" class="btn-success">Создать</my-button>
    </form>
</template>

<script>
import MySelect from "../UI/MySelect";
export default {
    name: "ActivitieForm",
    components: {MySelect},
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
                body_part: '',
                description: '',
            }
        }
    },
    mounted() {
        if (this.a) {
            this.aa.id = this.a.id;
            this.aa.name = this.a.name;
            this.aa.body_part = this.a.body_part;
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
                body_part: '',
                description: ''
            };
        }
    },
    computed: {
        bodyParts() {
            let bp = [];
            this.$store.state.body_parts.forEach(i => {
                bp.push({'value' : i.id, 'name' : i.name});
            })
            return bp;
        }
    }
}
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
    width: 500px;
}
</style>
