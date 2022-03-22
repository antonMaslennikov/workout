export default {
    methods: {
        hideDialog(event) {
            this.$emit('update:show', false);
        }
    },
    props: {
        show: {
            type: Boolean,
            default: false
        }
    }
}
