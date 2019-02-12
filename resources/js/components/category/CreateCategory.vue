<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field label="Category Name" v-model="form.name" type="text" required></v-text-field>
      <v-btn type="submit" color="pink white--text" v-if="editSlug">Update</v-btn>
      <v-btn type="submit" color="indigo darken-1 white--text" v-else>Create</v-btn>
    </v-form>

    <v-card>
      <v-toolbar color="indigo" dark dense class="mt-2">
        <v-toolbar-title>Categories</v-toolbar-title>
      </v-toolbar>

      <v-list>
        <div v-for="(category, index) in categories" :key="category.id">
          <v-list-tile>
            <v-list-tile-content>
              <v-list-tile-title>{{ category.name }}</v-list-tile-title>
            </v-list-tile-content>

            <v-list-tile-action>
              <v-item-group>
                <v-btn icon class="mr-2" @click="edit(index)">
                  <v-icon color="orange">edit</v-icon>
                </v-btn>
                <v-btn icon @click="destroy(category.slug, index)">
                  <v-icon color="red">delete</v-icon>
                </v-btn>
              </v-item-group>
            </v-list-tile-action>
          </v-list-tile>
          <v-divider></v-divider>
        </div>
      </v-list>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null
      },
      categories: {},
      editSlug: null
    };
  },
  created() {
    if (!User.admin()) {
      this.$router.push("/forum");
    }
    axios
      .get("/api/category")
      .then(res => (this.categories = res.data.data))
      .catch(error => console.log(error.response.data));
  },
  methods: {
    submit(index) {
      this.editSlug ? this.update(index) : this.create();
    },

    create() {
      axios.post("/api/category", this.form).then(res => {
        this.categories.unshift(res.data);
        this.form.name = null;
      });
    },

    edit(index) {
      this.form.name = this.categories[index].name;
      this.editSlug = this.categories[index].slug;
    },

    update(index) {
      axios.patch(`/api/category/${this.editSlug}`, this.form).then(res => {
        this.categories.splice(index, 1);
        this.categories.unshift(res.data);
        this.form.name = null;
        this.editSlug = null;
      });
    },

    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then(res => this.categories.splice(index, 1))
        .catch(err => err.response.data);
    }
  }
};
</script>

<style>
</style>
