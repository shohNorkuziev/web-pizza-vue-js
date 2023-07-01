import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth',{
    state: ()=>({
        role:'',
        name:'',
        succes:false
    }),
    actions:{
        setRole(role){
            this.role = role
        },
        setName(name){
            this.name = name
        },
        setSuccess(success){
            this.success = success
        }
    }

    
})