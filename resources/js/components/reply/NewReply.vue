<template>
  <v-container>
    <markdown-editor v-model="body"></markdown-editor>
    <v-btn color="green darken-1" dark @click="submit">
      <v-icon color="white">done</v-icon>Reply
    </v-btn>
  </v-container>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null
    };
  },
  methods: {
    submit() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, { body: this.body })
        .then(res => {
          this.body = "";
          EventBus.$emit("newReply", res.data.reply);
        });
    }
  }
};
</script>

<style>
</style>
