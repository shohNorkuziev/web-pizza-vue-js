<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
  setup() {
    const pizzas = ref([]);
    const categories = ref([]);
    const successMessage = ref('');
    const errorMessage = ref('');

    const getPizzas = () => {
      axios.get('http://localhost/pizza-app/includes/getPizzas.php')
        .then(response => {
          if (response.data.success) {
            pizzas.value = response.data.pizzas;
          } else {
            console.error('Ошибка при получении списка пицц:', response.data.message);
          }
        })
        .catch(error => {
          console.error('Ошибка при получении списка пицц:', error);
        });
    };

    const getCategories = () => {
      axios.get('http://localhost/pizza-app/includes/getCategories.php')
        .then(response => {
          if (response.data.success) {
            categories.value = response.data.categories;
          } else {
            console.error('Ошибка при получении списка категорий:', response.data.message);
          }
        })
        .catch(error => {
          console.error('Ошибка при получении списка категорий:', error);
        });
    };

    const savePizza = (pizza) => {
      const pizzaData = {
        id: pizza.id,
        name: pizza.name,
        id_categories: pizza.id_categories,
        price: pizza.price
      };

      axios.post('http://localhost/pizza-app/includes/EditPizza.php', JSON.stringify(pizzaData))
        .then(response => {
          if (response.data.success) {
            console.log('Данные пиццы успешно обновлены');
            successMessage.value = 'Данные пиццы успешно обновлены';
            errorMessage.value = '';
          } else {
            console.error('Ошибка при обновлении данных пиццы:', response.data.message);
            successMessage.value = '';
            errorMessage.value = 'Ошибка при обновлении данных пиццы';
          }
        })
        .catch(error => {
          console.error('Ошибка при обновлении данных пиццы:', error);
        });
    };

    const toggleEditing = (pizza) => {
      if (pizza.editing) {
        savePizza(pizza);
      }
      pizza.editing = !pizza.editing;
    };

    const deletePizza = (pizzaId) => {
      const pizzaData = {
        id: pizzaId
      };

      axios.post('http://localhost/pizza-app/includes/DeletePizza.php', JSON.stringify(pizzaData))
        .then(response => {
          if (response.data.success) {
            console.log('Пицца успешно удалена');
            successMessage.value = 'Пицца успешно удалена';
            errorMessage.value = '';
          } else {
            successMessage.value = '';
            errorMessage.value = 'Ошибка при удалении пиццы:';
            console.error('Ошибка при удалении пиццы:', response.data.message);
          }
        })
        .catch(error => {
          console.error('Ошибка при удалении пиццы:', error);
        });
    };
    const addPizza = () => {
      const newPizza = {
        id: null,
        title: '',
        description: '',
        size: '',
        price: '',
        images: '',
        id_categories: null,
        editing: true
      };
      pizzas.value.push(newPizza);
    };

    getPizzas();
    getCategories();

    return {
      pizzas,
      categories,
      toggleEditing,
      deletePizza,
      successMessage,
      errorMessage,
      addPizza
    };
  }
};
</script>


<template>
    <div class="pizza-management">
      <h2>Управление пиццами</h2>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Размер</th>
            <th>Цена</th>
            <th>Картинка</th>
            <th>Категория</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pizza in pizzas" :key="pizza.id">
            <td>{{ pizza.id }}</td>
            <td>
              <input v-model="pizza.title" :disabled="!pizza.editing" />
            </td>
            <td>
              <textarea v-model="pizza.description" :disabled="!pizza.editing"></textarea>
            </td>
            <td>
              <input v-model="pizza.size" :disabled="!pizza.editing" />
            </td>
            <td>
              <input v-model="pizza.price" :disabled="!pizza.editing" />
            </td>
            <td>
              <input v-model="pizza.images" :disabled="!pizza.editing" />
            </td>
            <td>
              <select v-model="pizza.id_categories" :disabled="!pizza.editing">
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
              </select>
            </td>
            <td>
              <button @click="toggleEditing(pizza)">
                {{ pizza.editing ? 'Сохранить' : 'Редактировать' }}
              </button>
              <button @click="deletePizza(pizza.id)">Удалить</button>
              <router-link to="/addPizza">Добавить пиццу</router-link>
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
.pizza-management {
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
  /* Стили для таблицы и других элементов компонента */
  </style>
  