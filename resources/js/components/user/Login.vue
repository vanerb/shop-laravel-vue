<template>
  <div class="container relative">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center">Iniciar Sesión</h2>
      </div>
      <div class="card-body">
        <form @submit.prevent="login">
          <div class="form-group mt-2">
            <input
              class="form-control"
              v-model="credentials.email"
              type="email"
              placeholder="Correo electrónico"
            />
          </div>
          <div class="form-group mt-2">
            <input
              class="form-control"
              v-model="credentials.password"
              type="password"
              placeholder="Contraseña"
            />
          </div>

          <button class="btn btn-success mt-2" type="submit">Iniciar Sesión</button>
        </form>
      </div>
    </div>

    <div class="div-warning" v-if="isFormError">
      <span >El usuario o contraseña no son correctos</span>
    </div>
  </div>

</template>

<script>

export default {
  data() {
    return {
      isFormError: false,
      credentials: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    closeModal() {
      this.isFormError = false;
    },
    async login() {
      try {
        axios
          .post("/api/login", this.credentials)
          .then((response) => {
            // La solicitud se ha realizado con éxito
            console.log("Usuario logueado:", response.data);
            sessionStorage.setItem("user", JSON.stringify(response.data));
            window.location.reload();
            this.$router.push({ name: "mostrarBlogs" });
            this.isFormError = false
            window.location.href= "/"
          })
          .catch((error) => {
            // Se ha producido un error en la solicitud
            console.error("Error al registrar usuario:", error);
            this.isFormError = true
            // Puedes manejar el error aquí
          });
      } catch (error) {
        console.error("Error al iniciar sesión:", error);
        this.isFormError = true
      }
    },
  },
};
</script>
