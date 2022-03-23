<template>

    <tr>
        <th scope="row">{{ a.id }}</th>
        <td>{{ a.name }}</td>
        <td>{{ a.description }}</td>
        <td>
            <my-button class="btn-sm btn-warning" @click="$emit('edit', a)"><i class="bi bi-pen"></i></my-button>
            &nbsp;
            &nbsp;
            <my-button class="btn-sm btn-danger" @click="$emit('remove', a)"><i class="bi bi-trash"></i></my-button>
        </td>
        <td class="td-move"><i class="bi bi-grip-vertical handle"></i></td>
    </tr>

</template>

<script>
import MyButton from "../UI/MyButton";

export default {
    name: "Item",
    components: {MyButton},
    props: {
        a: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>
.handle {
    cursor: move;
}

.td-move {
    width: 20px;
    text-align: right;
}
</style>
