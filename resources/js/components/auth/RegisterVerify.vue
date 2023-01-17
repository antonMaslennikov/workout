<template>
    <section v-if="error">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-12 col-lg-12 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <div class="text-danger">{{ error }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "RegisterVerify",
    data() {
        return {
            error: null
        }
    },
    mounted() {
        this.$store.dispatch('auth/verify', this.$route.params.token)
            .then(() => {
                this.$router.push('/')
            })
            .catch(err => this.error = err.response.data.message);
    }
}
</script>

<style scoped>

</style>
