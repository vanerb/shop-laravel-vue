<template>
  <div class="container">
    

    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th colspan="2"><router-link :to="{ name: 'register' }" class="btn btn-success text-center"
          >Add</router-link
        ></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
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
                  >Edit</router-link
                >
              </td>
              <td>
                <a
                  type="button"
                  @click="deleteuser(user.id)"
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
  name: "users",
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    console.log("Component mounted");
    this.showUser();
  },
  methods: {
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