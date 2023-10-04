<template>
    <div class="container">
        <h1 class="text-center">SHOP</h1>

        <div class="row">
            <div class="col-md-4 mt-4" v-for="product in products" :key="product.id">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>{{ product.name }}</h1>
                    </div>
                    <div class="card-body text-center">
                        <p>{{ product.description }}</p>
                        <h4>{{ product.price }} €</h4>
                    </div>
                    <div class="card-footer">
                        
                        <button class="btn btn-success w-100">Comprar</button>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "products",

    data() {
        return {
            products: [],
        };
    },
    mounted() {
        this.showProducts();
    },
    methods: {
        async showProducts() {
            await this.axios
                .get("/api/productall")
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.products = [];
                });
        },
    },
};
</script>
