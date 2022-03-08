<template>
  <input type="text"
         class="form-control input"
         :value="modelValue"
         @input="updateInput"
  >
</template>

<script>
export default {
  name: "my-input",
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
.input {
  margin-bottom: 15px;
}
</style>
