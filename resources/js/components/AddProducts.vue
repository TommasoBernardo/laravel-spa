<template lang="">
    <div class="container">
        <div class="card mt-5">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title"> Add new Product</h5>
                <div>
                    <router-link to="{name: 'products'}" class=" btn btn-success">Back</router-link>
                </div>
            </div>
            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>

            <form @submit.prevent="addProduct" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter Product name">
                </div>

                <div class="form-group mb-2">
                    <label>Description</label><span class="text-danger"> *</span>
                    <textarea class="form-control" rows="3" v-model="description" placeholder="Enter description for product"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Image</label><span class="text-danger"> *</span>
                    <input type="file" class="form-control mb-2" v-on:change="onChange">
                    <div v-if="img">
                    <img v-bind:src="imgPreview" widht="100" height="100">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label>Price</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter Product price">
                </div>
                
                <button type="submit" class="btn btn-primary mt-4 mb-4">Add Post</button>
                
            </form>
        </div>
    </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            name: '',
            description: '',
            img: '',
            price: '',
            strSuccess: '',
            strError: '',
            imgPreview: null
        }
    },
    methods: {
        onchange(e) {
            this.img = e.target.files[0];
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                this.imgPreview = reader.result;
            }.bind(this), false);

            if (this.img) {
                if (/\.(jpe?g|png|gif)$/i.test(this.img.name)) {
                    reader.readAsDataURL(this.img);
                }
            }
        },

        addProduct(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('file', this.file);
                formData.append('price', this.price);

                this.$axios.product('/api/products/add', formData, config)
                    .then(response => {
                        existingObj.strError = "";
                        existingObj.strSuccess = response.data.success;
                    })

                    .catch(function (error) {
                        existingObj.strSuccess = "";
                        existingObj.strError = error.response.data.message;
                    })
            });
        }
    },

    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
<style lang="">
    
</style>