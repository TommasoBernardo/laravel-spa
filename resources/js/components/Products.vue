<template lang="">
    <div class="container">
        <div class="card mt-5">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2 ">
            <h5 class="card-title">All products</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/products/add')">new post</button>
            </div>
        </div>
        <table class=" table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th widht="120" class="text-center">Image</th>
                    <th widht="200" class="text-center">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" ::key="product.id">
                <td class="text-center">{{index+1}}.</td>
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td class="text-center">
                    <div v-if="product.image">
                    <img src="" alt="product-img" widht="100" v-bind:src="'/img/'+product.image ">
                    </div>
                </td>
                <td class="text-center">
                    <router-link to="{name:'editproduct', params:{id:product.id}}" class="btn btn-warning">Edit</router-link>
                    <button class="btn btn-danger" @click="deleteProduct(product.id)">delete</button>
                </td>
                </tr>
            </tbody>
        </table>
    </div>
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
    methods: {
        deleteProduct(id) {
            console.log('delete');
        }
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