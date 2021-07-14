import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import user from "./modules/user/user";
const store = new Vuex.Store({
  state: {   
  }, 
  mutations: {},
  actions: {},
  modules: {
    user: user
  },
});
export default store;