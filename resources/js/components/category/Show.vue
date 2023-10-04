<template>
  <div class="container">
    

    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th colspan="2"><router-link :to="{ name: 'addcategory' }" class="btn btn-success text-center"
          >Add</router-link
        ></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categorys" :key="category.id">
              <th>{{ category.id }}</th>
              <td>{{ category.name }}</td>
              <td>
                <router-link
                  :to="{
                    name: 'editcategory',
                    params: { id: category.id },
                  }"
                  class="btn btn-primary"
                  >Edit</router-link
                >
              </td>
              <td>
                <a
                  type="button"
                  @click="deletecategory(category.id)"
                  class="btn btn-danger"
                  >Delete</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "categorys",
  data() {
    return {
      categorys: [],
    };
  },
  mounted() {
    console.log("Component mounted");
    this.showCategory();
  },
  methods: {
    async showCategory() {
      await this.axios
        .get("/api/category")
        .then((response) => {
          this.categorys = response.data;
        })
        .catch((error) => {
          this.categorys = [];
        });
    },
    

    async deletecategory(id) {
      await this.axios
        .delete(`/api/category/${id}`)
        .then((response) => {
          this.showCategory();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>