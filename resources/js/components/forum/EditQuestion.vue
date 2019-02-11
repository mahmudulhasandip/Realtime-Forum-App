<template>
  <v-container>
    <v-form @submit.prevent="create">
      <v-text-field v-model="form.title" type="text" label="Title" required></v-text-field>
      <markdown-editor v-model="form.body"></markdown-editor>
      <v-card-actions>
        <v-btn icon small>
          <v-icon color="teal" small>save</v-icon>
        </v-btn>
        <v-btn icon small>
          <v-icon small>cancel</v-icon>
        </v-btn>
      </v-card-actions>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: null,
        body: null
      }
    };
  }
};
</script>

<style>
</style>
