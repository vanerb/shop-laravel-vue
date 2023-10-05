<template>
  <div class="container">
    <div class="row" v-for="basket in displayedBasket" :key="basket.id">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>{{ getProductById(CleanNumber(basket.product_id)).name }}</h1>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                {{ getProductById(CleanNumber(basket.product_id)).description }}
              </div>
              <div class="col-md-2 text-center">
                {{ getProductById(CleanNumber(basket.product_id)).price }} €
              </div>
              <div class="col-md-2">
                <a
                  type="button"
                  @click="deletebasket(basket.id)"
                  class="btn btn-danger text-center"
                  >Delete</a
                >
              </div>
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
        :disabled="
          currentPage * basketPerPage >= baskets.length
        "
      >
        Siguiente
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "baskets",
  computed: {
    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
    displayedBasket() {
      const startIndex = (this.currentPage - 1) * this.basketPerPage;
      const endIndex = startIndex + this.basketPerPage;
      return this.baskets.slice(startIndex, endIndex);
    },
  },
  data() {
    return {
      currentPage: 1, // Página actual
      basketPerPage: 4, // Productos por página
      products: [],
      baskets: [],
    };
  },
  mounted() {
    console.log("Component mounted");
    this.showBaskets();
    this.showProducts();
  },
  methods: {
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      const lastPage = Math.ceil(this.baskets.length / this.basketPerPage);
      if (this.currentPage < lastPage) {
        this.currentPage++;
      }
    },
    async showProducts() {
      await this.axios
        .get("/api/product", { params: { user_id: this.info.user_id } })
        .then((response) => {
          this.products = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.products = [];
        });
    },
    CleanNumber(numeroString) {
      const numero = parseInt(numeroString, 10); // Convierte la cadena en un número entero
      return numero.toString(); // Convierte el número nuevamente en una cadena
    },
    getProductById(productId) {
      const productIdToName = {};
      this.products.forEach((product) => {
        productIdToName[product.id] = product;
      });

      return productIdToName[productId];
    },
    async showBaskets() {
      await this.axios
        .get("/api/basket", { params: { user_id: this.info.user_id } })
        .then((response) => {
          this.baskets = response.data;
        })
        .catch((error) => {
          this.baskets = [];
        });
    },

    async deletebasket(id) {
      await this.axios
        .delete(`/api/basket/${id}`)
        .then((response) => {
          this.showBaskets();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>