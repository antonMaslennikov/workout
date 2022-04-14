<template>
    <template v-if="isEdit">
        <input type="text"
               class="form-control input me-2"
               v-model="value">
        <button class="btn btn-success me-2" @click="save()"><i class="bi bi-check-lg"></i></button>
        <button class="btn btn-dark" @click="edit()"><i class="bi bi-x-lg"></i></button>
    </template>
    <template v-else>
        {{ text }}
        <a href="#" @click="edit()" style="margin-right: 10px;"><i class="bi bi-pen"></i></a>
    </template>
</template>

<script>
export default {
    name: "TextEdit",
    data() {
        return {
            isEdit: false,
            value: '',
        }
    },
    props: {
        text: [String, Number]
    },
    mounted() {
        this.value = this.text
    },
    methods: {
        edit() {
            this.isEdit = !this.isEdit;
        },
        save() {
            if (this.value != this.text) {
                this.$emit('save', this.value);
            }
            this.isEdit = !this.isEdit;
        }
    }
}
</script>

<style scoped>
.input {
    display: inline;
    width:300px;
}
</style>
