<template>
  <div class="container">
    <div class="row mt-4" v-if="isLogged">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h1>Administración productos</h1>
          </div>
          <div class="card-body">
            <router-link
              type="button"
              to="showproduct"
              class="btn btn-success w-100"
              >Ir</router-link
            >
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h1>Administración categorias</h1>
          </div>
          <div class="card-body">
            <router-link
              type="button"
              to="showcategory"
              class="btn btn-success w-100"
              >Ir</router-link
            >
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h1>Administración usuarios</h1>
          </div>
          <div class="card-body">
            <router-link
              type="button"
              to="showuser"
              class="btn btn-success w-100"
              >Ir</router-link
            >
          </div>
        </div>
      </div>
    </div>

    <div v-if="!isLogged">
      <h1 class="text-center mt-4">Tienes que iniciar sesión</h1>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    isLoggedIn() {
      // Puedes utilizar alguna lógica para determinar si el usuario está autenticado
      // Por ejemplo, comprobar si existe una variable de usuario en el almacenamiento local
      return sessionStorage.getItem("user") !== null;
    },

    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
    isLogged() {
      if (this.isLoggedIn) {
        if (this.info.user_id == 1) {
          console.log(this.info);
          return true;
        } else {
          return false;
        }
      }
      else{
        return false;
      }
    },
  },
};
</script>