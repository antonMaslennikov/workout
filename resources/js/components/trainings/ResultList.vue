<template>
    <ul>
        <li v-for="(r, index) in activitie.results"
                  :key="r.id">
            <div>Повторений: {{ r.repeats }}</div>
            <div>Вес: {{ r.weight }}</div>
        </li>
    </ul>
</template>

<script>
export default {
    name: "ResultList",
    components: {},
    props: {
        activitie: {
            type: Object,
            required: true
        },

    },
    data() {
        return {
        }
    },
    methods: {
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
