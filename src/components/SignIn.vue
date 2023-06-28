<template>
   <div class="signin">
     <div class="signin-container">
       <h2>Авторизация</h2>
       <form>
         <div class="form-group">
           <label for="email">Почта</label>
           <input type="email" id="email" v-model="email" required>
         </div>
         <div class="form-group">
           <label for="password">Пароль</label>
           <input type="password" id="password" v-model="password" required>
         </div>
         <button class="btn" @click="signIn">Войти</button>
       </form>
     </div>
     <div>
      <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
   </div>
   </div>
 </template>
 
 <script>
 export default {
   data() {
     return {
       email: '',
       password: '',
     };
   },
   methods: {
     signIn() {
       // Реализуйте здесь логику для авторизации пользователя
       // Отправьте данные на сервер для проверки и выполнения авторизации
     },
   },
 };
 </script>
 
 <style scoped>
 body {
   background-color: #ffdf8c;
   margin: 0;
 }
 
 .logo{
   width: 400px;
 }
 .signin {
   display: grid;
   place-items: center;
   grid-template-columns: 1fr 1fr;
   width: 800px;
   margin: 0 auto;
   height: 75vh;
   
 }
 
 .signin-container {
   background-color: #fff;
   padding: 20px;
   border-radius: 8px;
   max-width: 400px;
 }
 
 .form-group {
   margin-bottom: 20px;
 }
 
 label {
   display: block;
   font-weight: bold;
   margin-bottom: 5px;
 }
 
 input[type="email"],
 input[type="password"] {
   width: 100%;
   padding: 8px;
   border: 1px solid #ccc;
   border-radius: 4px;
 }
 
 .btn {
   background-color: #fe5f1e;
   color: #fff;
   padding: 10px 20px;
   border: none;
   border-radius: 4px;
   cursor: pointer;
 }
 
 .btn:hover {
   background-color: #ff833d;
 }
 </style>
 