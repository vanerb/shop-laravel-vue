<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Add category</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="addcategory">
          <div class="form-group">
            <label>Name</label>
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
          this.$router.push({ name: "categorys" });
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>
