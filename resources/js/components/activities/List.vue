<template>
    <div v-if="activities.length > 0">
<!--        <table class="table">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th scope="col">#</th>-->
<!--                <th scope="col">Название</th>-->
<!--                <th scope="col">Описание</th>-->
<!--                <th scope="col"></th>-->
<!--                <th scope="col"></th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--                <item-->
<!--                    v-for="a in activities"-->
<!--                    :a="a"-->
<!--                    :key="a.id"-->
<!--                    @edit="$emit('edit', a)"-->
<!--                    @remove="$emit('remove', a)"-->
<!--                />-->
<!--            </tbody>-->
<!--        </table>-->

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <draggable
                v-model="activities"
                group="people"
                @start="drag=true"
                @end="drag=false"
                @change="saveSort"
                item-key="id"
                tag="tbody"
                handle=".handle">
                <template #item="{element}">
                    <item
                        :a="element"
                        :key="element.id"
                        @edit="$emit('edit', element)"
                        @remove="$emit('remove', element)"
                    />
                </template>
            </draggable>
        </table>
    </div>
    <p v-else>
        Список постов пуст
    </p>
</template>

<script>
import Item from "./Item";
import draggable from 'vuedraggable';

export default {
    name: "ActivitiesList",
    components: {Item, draggable},
    data() {
        return {
            drag: false,
        }
    },
    props: {
        activities: {
            type: Array,
            required: true
        }
    },
    methods: {
        saveSort(e) {
            // console.log(e);

            let order = [];

            this.activities.forEach(i => {
                order.push(i.id);
            });

            this.$emit('saveSort', order);
        }
    }
}
</script>

<style scoped>

</style>
