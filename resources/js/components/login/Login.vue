<template>
  <v-container>
    <v-form @submit.prevent="login">
      <v-text-field v-model="form.email" type="email" label="Email" required></v-text-field>
      <v-text-field v-model="form.password" type="password" label="Password" required></v-text-field>
      <v-btn color="green" type="submit">Login</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null
      }
    };
  },
  methods: {
    login() {
      axios
        .post("/api/auth/login", this.form)
        .then(res => console.log(res.data))
        .catch(err => console.log(err.response.data));
    }
  }
};
</script>

<style>
</style>
