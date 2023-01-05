<template>
    <div class="dialog" v-if="show === true" @click="hideDialog">
        <div class="dialog__content" @click.stop>
            <slot></slot>
            <i class="dialog--hidebutton bi bi-x-circle" @click="hideDialog"></i>
        </div>
    </div>
</template>

<script>
import toggleMixin from "../../mixins/toggleMixin";

export default {
    name: "my-dialog",
    mixins: [toggleMixin]
}
</script>

<style scoped>
.dialog {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    display: flex;
    z-index: 99999;
}

.dialog__content {
    margin: auto;
    background: white;
    border-radius: 6px;
    min-height: 50px;
    min-width: 300px;
    padding: 40px 20px 20px 20px;
    position: relative;
}


.dialog.-large .dialog__content {
    min-width: 1000px;
}

@media screen and (max-width: 1000px) {
    .dialog.-large .dialog__content {
        min-width: unset;
        width: 98%;
    }
}

.dialog--hidebutton {
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
