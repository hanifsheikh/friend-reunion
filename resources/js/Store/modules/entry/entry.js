import axios from "axios"; 
import Vue from 'vue';
const entry = {
  namespaced: true,
  state: () => ({ 
    showModalActive: false,
    deleteModalActive: false,
    isLoading: false,
    isDeleting: false,
    tableData:[],
    errorMsg: null,
    selectedEntry:{}
  }),
  getters: {
    isLoading: (state) => {
      return state.isLoading;
    },
    isDeleting: (state) => {
      return state.isDeleting;
    },
    tableData: (state) => {
      return state.tableData;
    },
    errorMsg: (state) => {
      return state.errorMsg;
    },    
    selectedEntry: (state) => {
      return state.selectedEntry;
    },    
    showModalActive: (state) => {
      return state.showModalActive;
    },    
    deleteModalActive: (state) => {
      return state.deleteModalActive;
    },    
  },
  mutations: {    
    LOADING(state, payload) {
      state.isLoading = payload;
    },     
    DELETING(state, payload) {
      state.isDeleting = payload;
    },     
    SET_ERROR_MESSAGE(state, payload) {
      state.errorMsg = payload; 
    },
    SET_TABLE_DATA(state, payload) {
      state.tableData = payload; 
    },
    SHOW_MODAL(state, payload) {
      state.selectedEntry = payload; 
      state.showModalActive = true;
    },
    DELETE_MODAL(state, payload) {
      state.selectedEntry = payload; 
      state.deleteModalActive = true;
    },
    DELETE_TABLE_ENTRY(state, payload) { 
      state.tableData = state.tableData.filter(function (e) {
        return e.id != payload.id
      });        
    },
    CLOSE_MODAL(state) {      
      state.showModalActive = false;
      state.deleteModalActive = false;
    },
    SET_BLOB_IMAGE_URL(state, payload) {             
      var foundIndex = state.tableData.findIndex(x => x.id == payload.id);
      state.tableData[foundIndex].photo = payload.blob;
    },
  },

  actions: {
    viewEntry(context, payload){
     context.commit("SHOW_MODAL", payload)
    },
    deleteModal(context, payload){
     context.commit("DELETE_MODAL", payload)
    },
    destroyData(context, payload){
      context.commit("DELETING", true);
      axios.post(`./api/destroy/`, {id:payload}).then((response) => {  
        context.commit("DELETE_TABLE_ENTRY", response.data);
        Vue.noty.success('<b>' + response.data.name + "</b> has been deleted!");   
        context.commit("DELETING", false);
        context.commit("CLOSE_MODAL");
      }).catch(error => {
        context.commit("DELETING", false);
        context.commit("SET_ERROR_MESSAGE", error.response.data.message);        
      });
    },
    closeModal(context){
     context.commit("CLOSE_MODAL")
    },
    setBlobImageURL(context, payload){
      context.commit('SET_BLOB_IMAGE_URL', payload);
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
