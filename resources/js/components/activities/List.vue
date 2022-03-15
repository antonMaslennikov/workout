<template>
    <div v-if="activities.length > 0">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <item
                    v-for="a in activities"
                    :a="a"
                    :key="a.id"
                    @edit="$emit('edit', a)"
                    @remove="$emit('remove', a)"
                />
            </tbody>
        </table>
    </div>
    <p v-else>
        Список постов пуст
    </p>
</template>

<script>
import Item from "./Item";
export default {
    name: "ActivitiesList",
    components: {Item},
    props: {
        activities: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
