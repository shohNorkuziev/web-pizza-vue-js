<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      surname: '',
      email: '',
      password: '',
      passwordTwo: ''
    };
  },
  methods: {
    signUp() {
      // Проверка пароля
      if (this.password !== this.passwordTwo) {
        console.error('Пароли не совпадают');
        return;
      }

      const userData = {
        name: this.name,
        surname: this.surname,
        email: this.email,
        password: this.password,
        passwordTwo: this.passwordTwo
      };

      try {
        axios.post('http://localhost/pizza-app/includes/register.php', userData, {
   timeout: 50000,
   headers: {
     'Content-Type': 'application/json',
     'Content-Type': 'application/x-www-form-urlencoded'
   }
 })
        
          .then(response => {
            
            console.log(response.data);
            // Дополнительная логика после успешной регистрации
          })
          .catch(error => {
            console.error(error);
            // Дополнительная обработка ошибок регистрации
          });
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<template>
  <div class="signin">
    <div class="signin-container">
      <h2>Регистрация</h2>
      <form @click.prevent>
        <div class="form-group">
          <label for="name">Имя</label>
          <input type="text" id="name" v-model="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="surname">Фамилия</label>
          <input type="text" id="surname" v-model="surname" required>
        </div>
        <div class="form-group">
          <label for="email">Почта</label>
          <input type="email" id="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Пароль</label>
          <input type="password" id="password" v-model="password" required>
        </div>
        <div class="form-group">
          <label for="passwordTwo">Подтвердите пароль</label>
          <input type="password" id="passwordTwo" v-model="passwordTwo" required>
          <div v-if="password !== passwordTwo" class="error-message">Пароль не совпадает</div>
        </div>
        <button class="btn" type="submit" @click.stop.prevent="signUp">Регистрация</button>
        <div class="newUser">
          Уже есть в Vue pizza? <router-link to="/SignIn" class="wordAthoriz">Авторизоваться</router-link>
        </div>
      </form>
    </div>
    <div>
      <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
    </div>
  </div>
</template>

  <style scoped>
  .error-message {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}
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
  input[type="password"],
  input[type="text"],
  button {
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
  .wordAthoriz{
    color: blue;
  }
  </style>
  