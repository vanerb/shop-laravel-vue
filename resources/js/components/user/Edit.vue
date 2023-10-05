<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>Editar usuario</h1>
          </div>
          <div class="card-body">
            <form @submit.prevent="actualize">
              <div class="form-group mt-2">
                <input
                  class="form-control"
                  v-model="user.name"
                  type="text"
                  placeholder="Nombre"
                />
              </div>
              <div class="form-group mt-2">
                <input
                  class="form-control"
                  v-model="user.email"
                  type="email"
                  placeholder="Correo electrónico"
                />
              </div>

              <div class="form-group mt-2">
                <input
                  class="form-control"
                  v-model="user.password"
                  type="password"
                  placeholder="Contraseña"
                />
              </div>

              <div class="form-group mt-2">
                <button class="btn btn-success" type="submit">
                  Editar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "edituser",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: ""
      }
    };
  },
  mounted() {
    this.showUser();
  },
  methods: {
    async showUser() {
      this.axios
        .get(`/api/user/${this.$route.params.id}`)
        .then((response) => {
            console.log(response.data);
          const { name, email, password } = response.data;
            (this.user.name = name),
            (this.user.email = email),
            (this.user.password = password)

        })
        .catch((error) => {
          console.log(error);
        });
    },
    async actualize() {
      this.axios
        .put(`/api/user/${this.$route.params.id}`, this.user)
        .then((response) => {
          this.$router.push({
            name: "shop",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

