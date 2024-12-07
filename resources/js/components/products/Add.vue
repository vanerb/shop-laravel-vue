<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <svg v-if="isAdded"
          class="float-end"
          xmlns:svg="http://www.w3.org/2000/svg"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          version="1.0"
          width="32px"
          height="32px"
          viewBox="0 0 128 128"
          xml:space="preserve"
        >
          <g>
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#000000"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#e1e1e1"
              transform="rotate(45 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#e1e1e1"
              transform="rotate(90 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#e1e1e1"
              transform="rotate(135 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#bebebe"
              transform="rotate(180 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#979797"
              transform="rotate(225 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#6e6e6e"
              transform="rotate(270 64 64)"
            />
            <path
              d="M71 39.2V.4a63.6 63.6 0 0 1 33.96 14.57L77.68 42.24a25.53 25.53 0 0 0-6.7-3.03z"
              fill="#3c3c3c"
              transform="rotate(315 64 64)"
            />
            <animateTransform
              attributeName="transform"
              type="rotate"
              values="0 64 64;45 64 64;90 64 64;135 64 64;180 64 64;225 64 64;270 64 64;315 64 64"
              calcMode="discrete"
              dur="720ms"
              repeatCount="indefinite"
            ></animateTransform>
          </g>
          <g>
            <circle fill="#000000" cx="63.66" cy="63.16" r="12" />
            <animate
              attributeName="opacity"
              dur="720ms"
              begin="0s"
              repeatCount="indefinite"
              keyTimes="0;0.5;1"
              values="1;0;1"
            />
          </g>
        </svg>
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
            <select class="form-control bg-black text-white" v-model="product.category_id">
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
      isAdded: false,
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
          this.isAdded = true;
          this.$router.push({ name: "showproduct" });
        })
        .catch((error) => {
          this.isAdded = false;
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
