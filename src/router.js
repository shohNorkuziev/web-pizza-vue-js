import { createRouter, createWebHashHistory } from "vue-router";

import Basket from "./components/basket.vue"
import Index from "./components/index.vue"
import SignInVue from "./components/SignIn.vue"
import SignUpVue from "./components/SignUp.vue"
import DataUser from "./components/DataUser.vue"
import AdminPanel from "./components/AdminPanel.vue"
import EditUser from "./components/EditUser.vue"
import EditPizza from "./components/EditPizza.vue"

export default createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: "/",
      component: Index,
      alias: "/",
      name:'Index'
    },
    {
      path: "/Basket",
      component: Basket,
      name:'Basket'
    },
    {
      path: "/SignIn",
      component: SignInVue,
      name:'SignInVue'
    },
    {
      path: "/SignUp",
      component: SignUpVue,
      name:'SignUpVue'
    },
    {
      path: "/DataUser",
      component: DataUser,
      name:'DataUser'
    },
    {
      path: "/AdminPanel",
      component: AdminPanel,
      name:'AdminPanel'
    },
    {
      path: "/EditUser",
      component: EditUser,
      name:'EditUser'
    },
    {
      path: "/EditPizza",
      component: EditPizza,
      name:'EditPizza'
    },
  ],
});
