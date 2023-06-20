import { createRouter,createWebHashHistory } from 'vue-router'

import Basket from './components/basket.vue'
import Index from './components/index.vue'
import SignInVue from './components/SignIn.vue'
import SignUpVue from './components/SignUp.vue'

export default createRouter({
    history:createWebHashHistory(

    ),
    routes:[
        {path:'/Index', component: Index, alias:'/'},
        {path:'/Basket', component: Basket },
        {path:'/SignIn', component:SignInVue},
        {path:'/SignUp', component:SignUpVue}
    ],

})
