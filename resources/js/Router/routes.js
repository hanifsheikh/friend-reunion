import Login from "../Pages/Login.vue";
import Home from "../Pages/Home.vue";
import Admin from "../Pages/Admin.vue";
import store from "../Store/index";
const routes = [
    {
      path: "/admin", 
      name: "Admin",
      component: Admin,
      beforeEnter: (to, from, next) => {
        if (to.name !== "Login" && !store.getters['user/token']) next({ name: "Login" });
        else next();
      },
    }, 
    {
      path: "/", 
      name: "Home",
      component: Home,
      // beforeEnter: (to, from, next) => {
      //   if (to.name !== "Login" && !store.getters['user/token']) next({ name: "Login" });
      //   else next();
      // },
    }, 
    {
      path: "/login",
      name: "Login",
      component: Login,
      beforeEnter: (to, from, next) => {
        if (store.getters['user/token']) next(from);
        else next();
      },
    },
    {
      path: "/:pathMatch(.*)*",
      beforeEnter: (to, from, next) => {
        next({ name: "Home" });
      },
    },
  ];
export default routes  