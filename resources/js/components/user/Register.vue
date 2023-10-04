<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1>Registrarse</h1>
          </div>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="form-group mt-2">
                <input class="form-control"
                  v-model="registration.name"
                  type="text"
                  placeholder="Nombre"
                />
              </div>
              <div class="form-group mt-2">
                <input class="form-control"
                  v-model="registration.email"
                  type="email"
                  placeholder="Correo electrónico"
                />
              </div>

              <div class="form-group mt-2">
                <input class="form-control"
                  v-model="registration.password"
                  type="password"
                  placeholder="Contraseña"
                />
              </div>

 <div class="form-group mt-2">
  <button class="btn btn-success" type="submit">Registrarse</button>
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
  data() {
    return {
      registration: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async register() {
      try {
        axios
          .post("/api/user", this.registration)
          .then((response) => {
            // La solicitud se ha realizado con éxito
            console.log("Usuario registrado:", response.data);
            this.$router.push({ name: "login" });
          })
          .catch((error) => {
            // Se ha producido un error en la solicitud
            console.error("Error al registrar usuario:", error);
            // Puedes manejar el error aquí
          });
      } catch (error) {
        console.error("Error al registrarse:", error);
      }
    },
  },
};
</script>
