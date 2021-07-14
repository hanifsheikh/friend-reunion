import VueRouter from "vue-router";
import routes from "./routes";

import store from "../Store/index";
const router = new VueRouter({
  mode: 'hash',
  routes
});

router.beforeEach((to, from, next) => {
  store.commit('user/SET_ROUTE', to);
  next();
});
export default router;
