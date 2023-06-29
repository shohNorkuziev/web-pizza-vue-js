<template>
    <div class="signin">
      <div class="signin-container">
        <h2>Регистрация</h2>
        <form>
          <div class="form-group">
            <label for="email">Почта</label>
            <input type="email" id="email" v-model="email" required>
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" id="password" v-model="password" required>
          </div>
          <div class="form-group">
            <label for="password">Потвердите пароль</label>
            <input type="password" id="password" v-model="passwordTwo" required>
          </div>
          <button class="btn" @click="signUp">Регистрация</button>
        </form>
      </div>
      <div>
       <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
    </div>
    </div>
  </template>
  
  <script>
import { ref } from 'vue';

  export default {
    setup(){
      const email = ref('')
      const password = ref('')
      const passwordTwo = ref('')
        
      return{
        email,
        password,
        passwordTwo 
        }
    },
    methods: {
      signUp() {
        // Реализуйте здесь логику для авторизации пользователя
        // Отправьте данные на сервер для проверки и выполнения авторизации
      },
    },
  };
  </script>
  
  <style scoped>
  h2{
    margin: 10px;
  }
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
    font-weight: 700;
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
  