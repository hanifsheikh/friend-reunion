require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';
import VueNoty from 'vuejs-noty'
import router from './Router/index'
import store from './Store/index'
import App from './App.vue'
import './axios'
Vue.use(VueRouter)
Vue.use(require('vue-moment'));
const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App }
});

Vue.use(VueNoty, { layout: "bottomRight", theme: "metroui"});