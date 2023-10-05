<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Añadir categoría</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="addcategory">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" v-model="category.name" />
          </div>

          <button type="submit" class="btn btn-success mt-4">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "addcategory",
 
  data() {
    return {
      category: {
        name: "",
        
      }
    };
  },
  methods: {
    

    async addcategory() {
      await this.axios
        .post("/api/category", this.category)
        .then((response) => {
          this.$router.push({ name: "showcategory" });
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>
