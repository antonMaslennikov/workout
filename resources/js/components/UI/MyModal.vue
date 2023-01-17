<template>
<!--    <div class="modal fade" tabindex="-1" v-if="show === true" :class="{ 'show': show }" :style="styleObject">-->
    <div class="modal fade" tabindex="-1" v-show="show === true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><slot name="title"></slot></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hideDialog"></button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
<!--    <div v-if="show === true" :class="{'modal-backdrop fade' : show, 'show' : show}" @click="hideDialog"></div>-->
</template>

<script>
import toggleMixin from "../../mixins/toggleMixin";

export default {
    name: "my-modal",
    mixins: [toggleMixin],
    computed: {
        styleObject() {
            if (this.show) return { 'display': 'block' };
        }
    }
}
</script>

<style scoped>

</style>
