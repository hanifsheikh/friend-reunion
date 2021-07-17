import axios from "axios"; 

const entry = {
  namespaced: true,
  state: () => ({ 
    showModalActive: false,
    isLoading: false,
    tableData:[],
    errorMsg: null,
    showSelectedEntry:{}
  }),
  getters: {
    isLoading: (state) => {
      return state.isLoading;
    },
    tableData: (state) => {
      return state.tableData;
    },
    errorMsg: (state) => {
      return state.errorMsg;
    },    
    showSelectedEntry: (state) => {
      return state.showSelectedEntry;
    },    
    showModalActive: (state) => {
      return state.showModalActive;
    },    
  },
  mutations: {    
    LOADING(state, payload) {
      state.isLoading = payload;
    },     
    SET_ERROR_MESSAGE(state, payload) {
      state.errorMsg = payload; 
    },
    SET_TABLE_DATA(state, payload) {
      state.tableData = payload; 
    },
    SHOW_MODAL(state, payload) {
      state.showSelectedEntry = payload; 
      state.showModalActive = true;
    },
    CLOSE_MODAL(state) {      
      state.showModalActive = false;
    },
  },

  actions: {
    viewEntry(context, payload){
     context.commit("SHOW_MODAL", payload)
    },
    closeModal(context){
     context.commit("CLOSE_MODAL")
    },
    fetchData(context) {
      context.commit("SET_ERROR_MESSAGE", null);
      context.commit("LOADING", true);
      axios.get(`./api/fetchTableData`).then((response) => { 
        context.commit('SET_TABLE_DATA', response.data)
        context.commit("LOADING", false);
      }).catch(error => {
        context.commit("LOADING", false);
        context.commit("SET_ERROR_MESSAGE", error.response.data.message);        
      });
    },
    
  },
};
export default entry;
