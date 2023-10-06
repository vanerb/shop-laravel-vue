<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-4 text-center">
        <h1>{{ products.name }}</h1>
        <hr />
        <img
          :src="'/storage/' + products.image"
          alt=""
          max-width="500"
          height="300"
        />
        <p class="mt-4">{{ products.description }}</p>
        <div
        class="col-md-4 mt-4 mx-auto d-flex justify-content-center align-items-center"
      >
        <h2>{{ products.price }} €</h2>
      </div>
        <hr />
      </div>
      
    </div>

    <div class="row">
      <div class="col-md-12">
        <div v-if="isLogged">
          <button class="btn btn-success w-100" @click="comprar(products.id)">
            Comprar
          </button>
        </div>

        <div v-if="!isLogged">
          <router-link :to="{ name: 'login' }" class="btn btn-success w-100"
            >Iniciar sesión</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      basket: {
        product_id: "",
        user_id: "",
      },
    };
  },
  computed: {
    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
    isLogged() {
      if (this.info !== null) {
        return true;
      } else {
        return false;
      }
    },
  },
  mounted() {
    this.showProducts();
  },
  methods: {
    async showProducts() {
      await this.axios
        .get(`/api/product/${this.$route.params.id}`)
        .then((response) => {
          this.products = response.data;
          console.log(this.products);
        })
        .catch((error) => {
          console.log(error);
          this.products = [];
        });
    },

    async comprar(prod_id) {
      console.log("LLama funcion");
      this.basket.user_id = this.info.user_id;
      this.basket.product_id = prod_id;

      console.log(this.basket);
      await this.axios
        .post("/api/basket", this.basket)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>