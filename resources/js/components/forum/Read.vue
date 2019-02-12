<template>
  <div v-if="question">
    <edit-question :data="question" v-if="editing"></edit-question>
    <show-question :data="question" v-else></show-question>
    <new-reply :questionSlug="question.slug"></new-reply>
    <replies :question="question"></replies>
  </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
import replies from "./../reply/Replies";
import NewReply from "./../reply/NewReply";
export default {
  components: {
    ShowQuestion,
    EditQuestion,
    replies,
    NewReply
  },
  data() {
    return {
      question: null,
      editing: false
    };
  },
  created() {
    this.listen();
    this.getQuestion();
  },
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true;
      });

      EventBus.$on("cancelEditing", () => {
        this.editing = false;
      });
    },

    getQuestion() {
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then(res => (this.question = res.data.data));
    }
  }
};
</script>

<style>
</style>
