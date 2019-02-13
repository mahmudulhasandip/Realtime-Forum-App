/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import Vuetify from "vuetify";
import router from './Router/router';

window.Vue = require("vue");
Vue.use(Vuetify);

// import helper user class
import User from './Helpers/User';
window.User = User;

// import helper exception class
import Exception from './Helpers/Exception';
window.Exception = Exception;

// markdown editor
import VueSimplemde from 'vue-simplemde'
Vue.use(VueSimplemde)

import md from "marked";
window.md = md;



console.log(User.loggedIn());

window.EventBus = new Vue();


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("AppHome", require("./components/AppHome.vue").default);


const app = new Vue({
    el: "#app",
    router
});
