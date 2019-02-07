import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login.vue';

const routes = [{
    path: '/login',
    component: Login
}]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;
