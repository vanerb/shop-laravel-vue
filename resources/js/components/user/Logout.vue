<template>
  <div>
    <button @click="logout">Cerrar Sesión</button>
  </div>
</template>

<script>
export default {
  methods: {
    async logout() {
     try {
      // Eliminar los datos del usuario de la sesión (o localStorage/sessionStorage)
      sessionStorage.removeItem("user"); // O localStorage.removeItem("user") si es donde lo guardaste
      
      // Redirigir al usuario a la página de inicio o a donde desees
      this.$router.push({ name: "home" }); // Ajusta la ruta según tu configuración
    } catch (error) {
      console.error("Error al cerrar sesión:", error);
    }
    }
  }
};
</script>
