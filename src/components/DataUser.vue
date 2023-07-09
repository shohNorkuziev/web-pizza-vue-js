<script>
import { ref } from 'vue'
import axios from 'axios';
import { useStore } from '../store/store.js';

export default {
  setup() {
    const Store = useStore()
    const userData = {
      name: Store.name,
      surname: Store.surname,
      email: Store.email
    };
    const successMessage = ref('');
    const errorMessage = ref('');

    const saveChanges = () => {
      axios.post('http://localhost/pizza-app/includes/DataUser.php', userData)
        .then(response => {
          if (response.data.success) {
            // Обновление данных пользователя в хранилище после успешного сохранения
            Store.setName(userData.name);
            Store.setSurname(userData.surname);
            Store.setEmail(userData.email);
            successMessage.value = 'Данные успешно обновлены';
            errorMessage.value = '';
          } else {
            successMessage.value = '';
            errorMessage.value = 'Произошла ошибка при обновлении данных';
          }
        })
        .catch(error => {
          console.error('Ошибка при обновлении данных пользователя:', error);
          successMessage.value = '';
          errorMessage.value = 'Произошла ошибка при обновлении данных';
        });
    }

    return {
      userData,
      saveChanges,
      successMessage,
      errorMessage
    }
  }
};
</script>

<template>
  <div class="DataUser">
    <div class="DataUserContainer">
      <h2>Личные данные</h2>
      <form @click.prevent>
        <div>
          <label for="name">Имя:</label>
          <input id="name" v-model="userData.name" />
        </div>
        <div>
          <label for="surname">Фамилия:</label>
          <input id="surname" v-model="userData.surname" />
        </div>
        <div>
          <label for="email">Email:</label>
          <input id="email" v-model="userData.email" />
        </div>
      </form>
      <button class="btn" @click="saveChanges">Сохранить изменения</button>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
    <div>
      <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
    </div>
  </div>
</template>
  

  
<style scoped>
.success-message {
  color: green;
}

.error-message {
  color: red;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input,
button {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 15px;
}

.DataUser {
  display: grid;
  place-items: center;
  grid-template-columns: 1fr 1fr;
  width: 800px;
  margin: 0 auto;
  height: 75vh;
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

.logo {
  width: 400px;
}</style>
  