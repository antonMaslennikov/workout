export default {
    // data: {
    // },
    // mounted() {
    // },
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