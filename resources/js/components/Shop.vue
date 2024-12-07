<template>
  <div class="container">
    <h1 class="text-center">TIENDA</h1>

    <div class="row">
      <div
        class="col-md-4 mt-4"
        v-for="product in displayedProducts"
        :key="product.id"
      >
        <div class="card">
          <router-link class="text-decoration-none"
            :to="{
              name: 'showproductid',
              params: { id: product.id },
            }"
          >
            <div class="card-header text-center">
              <h1>{{ product.name }}</h1>
            </div>
            <div class="card-body text-center">
              <img
                class="mx-auto image-fit"
                :src="'storage/' + product.image"
                alt=""
            
              />
              <p>{{ product.description }}</p>
              <h4>{{ product.price }} €</h4>
            </div>
          </router-link>
        
        <div class="card-footer">
          <div v-if="isLogged">
            <button class="btn btn-success w-100" @click="comprar(product.id)">
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
    </div>

    <div class="text-center mt-4 mb-4">
      <button
        class="btn btn-secondary"
        @click="prevPage"
        :disabled="currentPage === 1"
      >
        Anterior
      </button>
      <span>{{ currentPage }}</span>
      <button
        class="btn btn-secondary"
        @click="nextPage"
        :disabled="currentPage * productsPerPage >= products.length"
      >
        Siguiente
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "products",

  data() {
    return {
      currentPage: 1, // Página actual
      productsPerPage: 9, // Productos por página
      basket: {
        product_id: "",
        user_id: "",
      },
      products: [],
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

    displayedProducts() {
      const startIndex = (this.currentPage - 1) * this.productsPerPage;
      const endIndex = startIndex + this.productsPerPage;
      return this.products.slice(startIndex, endIndex);
    },
  },
  mounted() {
    this.showProducts();
  },
  methods: {
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      const lastPage = Math.ceil(this.products.length / this.productsPerPage);
      if (this.currentPage < lastPage) {
        this.currentPage++;
      }
    },
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
