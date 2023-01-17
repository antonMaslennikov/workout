<template>
    <textarea
        class="form-control input"
        :value="modelValue"
        @input="updateInput"
        rows="7"
    >
    </textarea>
</template>

<script>
export default {
    name: "my-textarea",
    props: {
        modelValue: [String, Number]
    },
    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value)
        }
    }
}
</script>

<style scoped>
</style>
