import { defineStore } from 'pinia'

export const useStore = defineStore('Store',{
    state: ()=> ({
        id: Number,
        role:'',
        name:'',
        surname:'',
        email:'',
        success:false
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
        },
        setEmail(email){
            this.email = email
        },
        setSurname(surname){
            this.surname = surname
        },
        setId(id){
            this.id = id
        }
    }

    
})