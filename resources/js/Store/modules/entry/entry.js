import axios from "axios"; 

const entry = {
  namespaced: true,
  state: () => ({ 
    isLoading: false,
    errorMsg: null
  }),
  getters: {
    isLoading: (state) => {
      return state.isLoading;
    },
    errorMsg: (state) => {
      return state.errorMsg;
    },    
  },
  mutations: {    
    LOADING(state, payload) {
      state.isLoading = payload;
    },     
    SET_ERROR_MESSAGE(state, payload) {
      state.errorMsg = payload; 
    },
  },

  actions: {
    fetchData(context) {
      context.commit("SET_ERROR_MESSAGE", null);
      context.commit("LOADING", true);
      axios.get(`./api/fetchTableData`).then((response) => { 
        console.log(response.data);
        context.commit("LOADING", false);
      }).catch(error => {
        context.commit("LOADING", false);
        context.commit("SET_ERROR_MESSAGE", error.response.data.message);        
      });
    },
    
  },
};
export default entry;
