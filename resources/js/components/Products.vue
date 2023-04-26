<template lang="">
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2 ">
            <h5 class="card-title">All products</h5>
        </div>
        <button></button>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            products: [],
            strSuccess: '',
            strError: ''
        }
    },

    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/"
        }
        next();
    }
}
</script>
<style lang="">
    
</style>