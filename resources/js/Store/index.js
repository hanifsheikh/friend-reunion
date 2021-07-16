import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import user from "./modules/user/user";
import entry from "./modules/entry/entry";
const store = new Vuex.Store({
  state: {   
  }, 
  mutations: {},
  actions: {},
  modules: {
    user: user,
    entry: entry
  },
});
export default store;