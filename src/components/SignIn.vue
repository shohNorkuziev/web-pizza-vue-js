<script>
import axios from 'axios';
import router from '../router.js';
import { useStore } from '../store/store';

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage:'',
    };
  },
  methods: {
    signIn() {
      const userData = {
        email: this.email,
        password: this.password
      };

      axios.post('http://localhost/pizza-app/includes/authoriz.php', userData, {
        timeout: 50000,
        headers: {
          'Content-Type': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(response => {
          console.log(response.data);
          if(response.data.success){
            const Store = useStore()
              Store.setRole(response.data.role)
              Store.setName(response.data.name)
              Store.setSuccess(response.data.success)
              Store.setSurname(response.data.surname)
              Store.setId(response.data.id)
              Store.setEmail(response.data.email)
            router.push({name: 'Index'})
          }else{
            this.errorMessage = response.data.message
          }
        })
        .catch(error => {
          if (error.response) {
            // Ошибка с полученным ответом от сервера
            console.error('Ошибка ответа от сервера:', error.response.data);
          } else if (error.request) {
            // Ошибка без полученного ответа от сервера
            console.error('Ошибка запроса:', error.request);
          } else {
            // Ошибка при настройке запроса
            console.error('Ошибка настройки запроса:', error.message);
          }
        });

    }


  },
};
</script>

<template>
  <div class="signin">
    <div class="signin-container">
      <h2>Авторизация</h2>
      <div v-if="errorMessage" class="errorMessage">{{ errorMessage }}</div>
      <form @click.prevent>
        <div class="form-group">
          <label for="email">Почта</label>
          <input type="email" id="email" v-model="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Пароль</label>
          <input type="password" id="password" v-model="password" name="password" required>
        </div>
        <button class="btn" @click.stop.prevent="signIn">Войти</button>
        <div class="newUser">
          Новичок в Vue pizza? <router-link to="/SignUp" class="wordRegister">Зарегистрироваться</router-link>
        </div>
      </form>
    </div>
    <div>
      <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
    </div>
  </div>
</template>
 
<style scoped>
.errorMessage{
  color: red;
  margin-top: 10px;
}
h2 {
  margin: 10px;
}

body {
  background-color: #ffdf8c;
  margin: 0;
}

.logo {
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
button {
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
  font-weight: bold;
  font-size: 15px;
  width: 100%;
}

.btn:hover {
  background-color: #ff833d;
}

.wordRegister {
  color: blue;
}
</style>
 