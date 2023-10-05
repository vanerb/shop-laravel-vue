<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th colspan="2">
                <router-link
                  :to="{ name: 'addcategory' }"
                  class="btn btn-success text-center"
                  >Añadir</router-link
                >
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category) in displayedCategorys" :key="category.id">
              <th>{{ category.id }}</th>
              <td>{{ category.name }}</td>
              <td>
                <router-link
                  :to="{
                    name: 'editcategory',
                    params: { id: category.id },
                  }"
                  class="btn btn-primary"
                  >Editar</router-link
                >
              </td>
              <td>
                <a
                  type="button"
                  @click="deletecategory(category.id)"
                  class="btn btn-danger"
                  >Eliminar</a
                >
              </td>
            </tr>
          </tbody>
        </table>
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
              currentPage * categorysPerPage >= categorys.length 
            "
          >
            Siguiente
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "categorys",
  data() {
    return {
      currentPage: 1, // Página actual
      categorysPerPage: 6, // Productos por página
      categorys: [],
    };
  },
  computed: {
    displayedCategorys() {
      const startIndex = (this.currentPage - 1) * this.categorysPerPage;
      const endIndex = startIndex + this.categorysPerPage;
      return this.categorys.slice(startIndex, endIndex);
    },
  },
  mounted() {
    console.log("Component mounted");
    this.showCategory();
  },
  methods: {
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      const lastPage = Math.ceil(this.categorys.length / this.categorysPerPage);
      if (this.currentPage < lastPage) {
        this.currentPage++;
      }
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

    async deletecategory(id) {
      await this.axios
        .delete(`/api/category/${id}`)
        .then((response) => {
          this.showCategory();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>