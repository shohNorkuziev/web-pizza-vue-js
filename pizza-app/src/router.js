import { createRouter,createWebHashHistory } from 'vue-router'

import Basket from './components/Basket.vue'
import Index from './components/Index.vue'

export default createRouter({
    history:createWebHashHistory(

    ),
    routes:[
        {path:'/Index', component: Index, alias:'/'},
        {path:'/Basket', component: Basket }
        
    ],

})
