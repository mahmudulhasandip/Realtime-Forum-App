<template>
  <div>
    <markdown-editor v-model="reply.reply"></markdown-editor>
    <v-card-actions>
      <v-btn icon @click="update">
        <v-icon color="green" small>save</v-icon>
      </v-btn>
      <v-btn icon @click="cancel">
        <v-icon color="black" small>cancel</v-icon>
      </v-btn>
    </v-card-actions>
  </div>
</template>

<script>
export default {
  props: ["reply"],
  data() {
    return {};
  },
  methods: {
    cancel() {
      EventBus.$emit("cancelEditing");
    },
    update() {
      axios
        .patch(
          `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
          { body: this.reply.reply }
        )
        .then(res => this.cancel());
    }
  }
};
</script>

<style>
</style>
