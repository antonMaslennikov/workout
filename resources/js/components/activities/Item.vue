<template>

        <tr>
            <th scope="row">{{ a.id }}</th>
            <td>{{ a.name }}</td>
            <td>{{ a.description }}</td>
            <td><my-button class="btn-sm btn-danger"><i class="bi bi-basket"></i></my-button></td>
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

</style>
