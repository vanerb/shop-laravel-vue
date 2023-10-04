<template>
  <div class="container">
    

    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">User</th>
              <th scope="col">Category</th>
              <th colspan="2"><router-link :to="{ name: 'addproduct' }" class="btn btn-success text-center"
          >Add</router-link
        ></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products" :key="product.id">
              <th>{{ product.id }}</th>
              <td>{{ product.name }}</td>
              <td>{{ product.description }}</td>
              <td>{{ product.price }}</td>
              <td>{{ getUserById(CleanNumber(product.user_id)) }}</td>
              <td>{{ getCategoryById(CleanNumber(product.category_id)) }}</td>
              <td>
                <router-link
                  :to="{
                    name: 'editproduct',
                    params: { id: product.id },
                  }"
                  class="btn btn-primary"
                  >Edit</router-link
                >
              </td>
              <td>
                <a
                  type="button"
                  @click="deleteproduct(product.id)"
                  class="btn btn-danger"
                  >Delete</a
                >
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
  name: "products",
  computed: {
    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
  },
  data() {
    return {
      products: [],
      categorys: [],
      users: []
    };
  },
  mounted() {
    console.log("Component mounted");
    this.showProducts();
    this.showCategory();
    this.showUsers();
  },
  methods: {
    CleanNumber(numeroString) {
      const numero = parseInt(numeroString, 10); // Convierte la cadena en un número entero
      return numero.toString(); // Convierte el número nuevamente en una cadena
    },

    getCategoryById(categoryId) {
      const categoryIdToName = {};
      this.categorys.forEach((categoria) => {
        categoryIdToName[categoria.id] = categoria.name;
      });

      // Utiliza el mapeo para obtener el nombre de la categoría
      const categoryName = categoryIdToName[categoryId];

      return categoryName ? categoryName : "N/A";
    },
    getUserById(userId){
      const userIdToName = {};
      this.users.forEach((user) => {
        userIdToName[user.id] = user.name;
      });

      // Utiliza el mapeo para obtener el nombre de la categoría
      const userName = userIdToName[userId];

      return userName ? userName : "N/A";
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
    async showCategory() {
      await this.axios
        .get("/api/category")
        .then((response) => {
          this.categorys = response.data;
        })
        .catch((error) => {
          this.categorys = [];
        });
    },
    async showUsers() {
      await this.axios
        .get("/api/user")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          this.users = [];
        });
    },

    async deleteproduct(id) {
      await this.axios
        .delete(`/api/product/${id}`)
        .then((response) => {
          this.showProducts();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
