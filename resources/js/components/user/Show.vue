<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Email</th>
              <th colspan="2">
                <router-link
                  :to="{ name: 'register' }"
                  class="btn btn-success text-center"
                  >Add</router-link
                >
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in displayedUser" :key="user.id">
              <th>{{ user.id }}</th>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <router-link
                  :to="{
                    name: 'edituser',
                    params: { id: user.id },
                  }"
                  class="btn btn-primary"
                  >Editar</router-link
                >
              </td>
              <td>
                <a
                  type="button"
                  @click="deleteuser(user.id)"
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
              currentPage * usersPerPage >= users.length
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
  name: "users",
  data() {
    return {
      currentPage: 1, // Página actual
      usersPerPage: 6, // Productos por página
      users: [],
    };
  },
  computed: {
    displayedUser() {
      const startIndex = (this.currentPage - 1) * this.usersPerPage;
      const endIndex = startIndex + this.usersPerPage;
      return this.users.slice(startIndex, endIndex);
    },
  },
  mounted() {
    console.log("Component mounted");
    this.showUser();
  },
  methods: {
     prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      const lastPage = Math.ceil(this.users.length / this.usersPerPage);
      if (this.currentPage < lastPage) {
        this.currentPage++;
      }
    },
    async showUser() {
      await this.axios
        .get("/api/user")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          this.users = [];
        });
    },

    async deleteuser(id) {
      await this.axios
        .delete(`/api/user/${id}`)
        .then((response) => {
          this.showUser();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>