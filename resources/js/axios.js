import axios from "axios";
import store from "./Store";
 
// axios.defaults.baseURL = "https://mukti-coxsbazar.000webhostapp.com/api";
axios.defaults.headers.common['Authorization'] = `Bearer ${store.getters['user/token']}`;
 