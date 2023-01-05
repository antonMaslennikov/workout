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
                <th scope="col">Часть тела</th>
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

        <my-pagination
            :page="$store.getters['activitie/page']"
            :totalPages="$store.getters['activitie/totalPages']"
            @setPage="setPage"
        ></my-pagination>
    </div>
    <p v-else>
        Список упражнений пуст
    </p>
</template>

<script>
import Item from "./Item";
import draggable from 'vuedraggable';
import MyPagination from "../UI/MyPagination";

export default {
    name: "ActivitiesList",
    components: {MyPagination, Item, draggable},
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
        },
        setPage(page) {
            this.$store.dispatch('activitie/setPage', page)
                .then(() => {
                    this.$router.push({name: 'activities', params: {'page' : page > 1 ? page : ''}})
                })
        }
    }
}
</script>

<style scoped>

</style>
