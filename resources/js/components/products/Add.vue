<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Añadir producto</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="addproduct" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" v-model="product.name" />
          </div>

          <div class="form-group">
            <label>Descripción</label>
            <input
              type="text"
              class="form-control"
              v-model="product.description"
            />
          </div>

          <div class="form-group">
            <label>Imagen</label>
            <input
              type="file"
              class="form-control"
              @change="handleImageChange"
              ref="imageInput"
            />
          </div>

          <div class="form-group">
            <label>Precio</label>
            <input type="text" class="form-control" v-model="product.price" />
          </div>

          <div class="form-group">
            <label>Categoría</label>
            <select class="form-control" v-model="product.category_id">
              <option
                v-for="category in categorys"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>

          <button type="submit" class="btn btn-success mt-4">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "addproduct",
  computed: {
    info() {
      // Obtener la cadena JSON de sessionStorage
      const userData = sessionStorage.getItem("user");

      // Parsear la cadena JSON en un objeto JavaScript
      const userObject = JSON.parse(userData);

      // Acceder a las propiedades del objeto
      return userObject;
    },
  },
  data() {
    return {
      product: {
        name: "",
        description: "",
        price: "",
        image: "",
        category_id: "",
      },
      categorys: [],
    };
  },
  mounted() {
    this.showCategory();
  },
  methods: {
    handleImageChange(event) {
      const selectedImage = event.target.files[0];
      this.product.image = selectedImage;
    },
    async addproduct() {
      //this.product.user_id = this.info.user_id;
      console.log(this.product);
      const formData = new FormData();
      formData.append("name", this.product.name);
      formData.append("description", this.product.description);
      formData.append("price", this.product.price);
      formData.append("image", this.product.image); // Aquí agregamos la imagen
      formData.append("category_id", this.product.category_id);
      formData.append("user_id", this.info.user_id);
      console.log(formData);
      await this.axios
        .post("/api/product", formData)
        .then((response) => {
          this.$router.push({ name: "showproduct" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async showCategory() {
      await this.axios
        .get("/api/category")
        .then((response) => {
          this.categorys = response.data;
          console.log(this.categorys);
        })
        .catch((error) => {
          console.log(error);
          this.categorys = [];
        });
    },
  },
};
</script>
