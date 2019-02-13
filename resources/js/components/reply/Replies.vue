<template>
  <v-container>
    <reply v-for="(reply, index) in contents" :key="reply.id" :index="index" :data="reply"></reply>
  </v-container>
</template>

<script>
import Reply from "./reply";
export default {
  props: ["question"],
  data() {
    return {
      contents: this.question.replies
    };
  },
  components: { Reply },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("newReply", reply => {
        this.contents.unshift(reply);
      });

      EventBus.$on("deleteReply", index => {
        axios
          .delete(
            `/api/question/${this.question.slug}/reply/${
              this.contents[index].id
            }`
          )
          .then(res => {
            this.contents.splice(index, 1);
          });
      });

      Echo.private("App.User." + User.id()).notification(notification => {
        this.contents.unshift(notification.reply);
      });

      Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
        for (let index = 0; index < this.contents.length; index++) {
          if (this.contents[index].id == e.id) {
            this.contents.splice(index, 1);
          }
        }
      });
    }
  }
};
</script>

<style>
</style>
