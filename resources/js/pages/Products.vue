
<script>
import axios from 'axios';
export default {
    name: 'Products',
    data() {
        return {
            products: [],
            loading: false,
            urlAddress: '',
        }
    },

    methods: {
        getPosts() {
            axios.get(this.urlAddress, {
                params: {

                }
            })
                .then((response) => {
                    this.posts = response.data.results.data;
                })
                .catch(function (error) {
                    console.warn(error);
                });
        }
    },

    created() {
        this.getProducts();
    }
}
</script>

