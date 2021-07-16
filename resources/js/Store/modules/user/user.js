import axios from "axios";
import router from "../../../Router/index";

const user = {
  namespaced: true,
  state: () => ({
    route: null,
    token: localStorage.getItem("token") || null,
    isLoading: false,
    errorMsg: null
  }),
  getters: {
    token: (state) => {
      return state.token;
    },
    isLoading: (state) => {
      return state.isLoading;
    },
    errorMsg: (state) => {
      return state.errorMsg;
    },    
  },
  mutations: {
    SET_ROUTE(state, route) {
      state.route = route;
    },
    LOADING(state, payload) {
      state.isLoading = payload;
    },
    SET_TOKEN(state, token) {
      state.token = token;
    },
    REVOKE_TOKEN(state) {
      state.token = null;
      localStorage.removeItem("token");
    },
    SET_ERROR_MESSAGE(state, payload) {
      state.errorMsg = payload; 
    },
  },

  actions: {
    checkToken(context){ 
      if((context.state.token !== localStorage.getItem('token') || !context.state.token) && context.state.route.name != "Login"){ 
        this.dispatch('user/logout', {}, {root:true});     
      }      
    },
    
    loginUser(context, payload) {
      context.commit("SET_ERROR_MESSAGE", null);
      context.commit("LOADING", true);
      axios.post(`./api/login`, payload).then((response) => {
        context.commit("SET_TOKEN", response.data.token);
        localStorage.setItem("token", response.data.token);
        axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${response.data.token}`;
        router.push({ name: "Admin" });
        context.commit("LOADING", false);
      }).catch(error => {
        context.commit("LOADING", false);
        context.commit("SET_ERROR_MESSAGE", error.response.data.message);
        
      });
    },

    logout(context) {
      axios.post(`/logout`).then((response) => {
        context.commit("REVOKE_TOKEN");
        router.push({ name: "Login" });
      }).catch(error => {
        context.commit("REVOKE_TOKEN");
        router.push({ name: "Login" });
      });
    },
  },
};
export default user;
