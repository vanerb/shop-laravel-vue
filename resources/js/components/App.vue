<template>
  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Vanerb</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link
              exact-active-class="active"
              to="/"
              class="nav-link"
              aria-current="page"
              >Inicio</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              exact-active-class="active"
              to="/shop"
              class="nav-link"
              aria-current="page"
              >Tienda</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              exact-active-class="active"
              to="/contact"
              class="nav-link"
              aria-current="page"
              >Contacto</router-link
            >
          </li>
        </ul>

        <!-- Botones de autenticación -->

        <ul class="navbar-nav float-end mr-2">
          <li v-if="isAdmin" class="nav-item">
            <router-link
              :to="{ name: 'adminpanel' }"
              class="nav-link btn btn-link"
              >Administrar</router-link
            >
          </li>
          <li v-if="!isLoggedIn" class="nav-item">
            <a class="nav-link btn btn-link" @click="redirectToLogin"
              >Iniciar Sesión</a
            >
          </li>
          <li v-if="!isLoggedIn" class="nav-item">
            <a class="nav-link btn btn-link" @click="redirectToRegister"
              >Registrarse</a
            >
          </li>
          <li v-if="isLoggedIn" class="nav-item">
            <a class="nav-link btn btn-link" @click="logout">Cerrar Sesión</a>
          </li>
          <li v-if="isLoggedIn">
            <a class="nav-link btn btn-link" href="/"> {{ info.user.name }}</a>
          </li>
        </ul>
      </div>
    </nav>

    <div>
      <router-view></router-view>
    </div>
  </main>
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
    isAdmin() {
      if (this.isLoggedIn) {
        if (this.info.user_id == 1) {
          return true;
        } else {
          return false;
        }
      }
    },
  },
  methods: {
    redirectToLogin() {
      // Redirige al usuario a la página de inicio de sesión
      this.$router.push("/login");
    },
    redirectToRegister() {
      // Redirige al usuario a la página de registro
      this.$router.push("/register");
    },
    logout() {
      // Realiza la lógica de cierre de sesión aquí
      // Puede incluir una llamada a la API para cerrar la sesión en el servidor
      // Y luego eliminar la información de autenticación del almacenamiento local
      sessionStorage.removeItem("user");
      // Redirige al usuario a la página de inicio
      window.location.reload();
      this.$router.push("/login");
    },
  },
};
</script>