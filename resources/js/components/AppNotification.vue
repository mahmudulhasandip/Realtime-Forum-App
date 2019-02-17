<template>
  <div class="text-xs-center">
    <v-menu offset-y>
      <v-btn icon slot="activator">
        <v-icon :color="color">notifications</v-icon>
        {{ unreadCount }}
      </v-btn>
      <v-list>
        <v-list-tile v-if="unread.length == 0 && read.length == 0">
          <v-list-tile-title>No new notification</v-list-tile-title>
        </v-list-tile>
        <v-list-tile v-for="item in unread" :key="item.id">
          <router-link :to="item.path">
            <v-list-tile-title @click="readId(item)">{{ item.question }}</v-list-tile-title>
          </router-link>
        </v-list-tile>
        <v-divider></v-divider>

        <v-list-tile v-for="item in read" :key="item.id">
          <v-list-tile-title>{{item.question}}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
export default {
  data() {
    return {
      read: {},
      unread: {},
      unreadCount: 0,
      sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3"
    };
  },
  computed: {
    color() {
      return this.unreadCount > 0 ? "red" : "red lighten-4";
    }
  },
  created() {
    if (User.loggedIn()) {
      this.getNotifications();
    }

    Echo.private("App.User." + User.id()).notification(notification => {
      this.playSound();
      this.unread.unshift(notification);
      this.unreadCount++;
    });
  },
  methods: {
    playSound() {
      let alert = new Audio(this.sound);
      alert.play();
    },
    getNotifications() {
      axios
        .post("/api/notifications")
        .then(res => {
          this.read = res.data.read;
          this.unread = res.data.unread;
          this.unreadCount = res.data.unread.length;
        })
        .catch(error => Exception.handle(error));
    },

    readId(notification) {
      axios.post("/api/markAsRead", { id: notification.id }).then(res => {
        this.unread.splice(notification, 1);
        this.read.push(notification);
        this.unreadCount--;
      });
    }
  }
};
</script>

<style>
</style>
