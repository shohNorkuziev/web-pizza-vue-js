<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
  setup() {
    const roles = ref([]);
    const users = ref([]);
    const successMessage = ref('');
    const errorMessage = ref('');

    axios.get('http://localhost/pizza-app/includes/GotUser.php')
      .then(response => {
        if (response.data.success) {
          users.value = response.data.users;
        } else {
          
          console.error('Ошибка при получении данных пользователей:', response.data.message);
        }
      })
      .catch(error => {
        console.error('Ошибка при получении данных пользователей:', error);
      });

    axios.get('http://localhost/pizza-app/includes/getRoles.php')
      .then(response => {
        if (response.data.success) {
          roles.value = response.data.roles;
        } else {
          console.error('Ошибка при получении списка ролей:', response.data.message);
        }
      })
      .catch(error => {
        console.error('Ошибка при получении списка ролей:', error);
      });

    const saveUser = (user) => {
      const userData = {
        id: user.id,
        name: user.name,
        surname: user.surname,
        email: user.email,
        role: user.role
      };

      axios.post('http://localhost/pizza-app/includes/EditUser.php', JSON.stringify(userData))
        .then(response => {
          if (response.data.success) {
            console.log('Данные пользователя успешно обновлены');
            successMessage.value = 'Данные пользователя успешно обновлены';
            errorMessage.value = '';
          } else {
            console.error('Ошибка при обновлении данных пользователя:', response.data.message);
            successMessage.value = ''+ response.data.message;
            errorMessage.value = 'Ошибка при обновлении данных пользователя';
          }
        })
        .catch(error => {
          console.error('Ошибка при обновлении данных пользователя:', error);
        });
    };

    const toggleEditing = (user) => {
      if (user.editing) {
        saveUser(user);
      }
      user.editing = !user.editing;
    };

    const deleteUser = (userId) => {
      const userData = {
        id: userId
      };

      axios.post('http://localhost/pizza-app/includes/DeleteUser.php', JSON.stringify(userData))
        .then(response => {
          if (response.data.success) {
            console.log('Пользователь успешно удален');
            successMessage.value = 'Пользователь успешно удален';
            errorMessage.value = '';
          } else {
            successMessage.value = '';
            errorMessage.value = 'Ошибка при удалении пользователя';
            console.error('Ошибка при удалении пользователя:', response.data.message);
          }
        })
        .catch(error => {
          console.error('Ошибка при удалении пользователя:', error);
        });
    };

    return {
      roles,
      users,
      toggleEditing,
      deleteUser,
      successMessage,
      errorMessage
    };
  }
};
</script>


<template>
    <div class="user-management">
      <h2>Управление пользователями</h2>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>
              <input v-model="user.name" :disabled="!user.editing" />
            </td>
            <td>
              <input v-model="user.surname" :disabled="!user.editing" />
            </td>
            <td>
              <input v-model="user.email" :disabled="!user.editing" />
            </td>
            <td>
              <select required v-model="user.role" :disabled="!user.editing">
                <option v-for="role in roles" :key="role.id" :value="role.id" v-bind:selected="role.id === user.role">{{ role.id }}</option>
              </select>
            </td>
            <td>
              <button @click="toggleEditing(user)">
                {{ user.editing ? 'Сохранить' : 'Редактировать' }}
              </button>
              <button @click="deleteUser(user.id)">Удалить</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  
  <style scoped>
  .success-message {
  color: green;
}

.error-message {
  color: red;
}
  .user-management {
    text-align: center;
    margin: 20px;
    margin-bottom: 15px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    padding: 10px;
    border: 1px solid #ccc;
  }
  
  thead {
    background-color: #f1f1f1;
  }
  
  button {
    padding: 5px 10px;
    margin-right: 5px;
  }
  </style>
  