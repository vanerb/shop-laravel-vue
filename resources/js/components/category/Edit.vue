<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Editar categoría</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="actualize">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" v-model="category.name" />
          </div>

          <button type="submit" class="btn btn-success mt-4">Editar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "editcategory",
  
  data() {
    return {
      category: {
        name: ""
      }
    };
  },
  mounted() {
    this.showCategory();
  },
  methods: {
    
    async showCategory() {
      this.axios
        .get(`/api/category/${this.$route.params.id}`)
        .then((response) => {
            console.log(response.data);
          const { name} = response.data;
            (this.category.name = name)
            

        })
        .catch((error) => {
          console.log(error);
        });
    },
    
    async actualize() {
      this.axios
        .put(`/api/category/${this.$route.params.id}`, this.category)
        .then((response) => {
          this.$router.push({
            name: "showcategory",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
