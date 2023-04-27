<template>
    <div class="card mb-3 " style="max-width: 540px;">
        <div class="row g-0 ">
            <div class="col-md-4">
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png"
                    class="img-fluid rounded-start" alt="image-not-found">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Welcome {{ name }}</h5>
                    <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius expedita, laudantium
                        similique illo voluptates sequi?</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            name: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.user.name
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