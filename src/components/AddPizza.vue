<template>
    <div class="add-pizza">
      <h2>Добавить пицу</h2>
      <div>
        <label for="title">Название:</label>
        <input type="text" id="title" v-model="pizza.title" />
      </div>
      <div>
        <label for="description">Описание:</label>
        <textarea id="description" v-model="pizza.description"></textarea>
      </div>
      <div>
        <label for="size">Размер:</label>
        <input type="text" id="size" v-model="pizza.size" />
      </div>
      <div>
        <label for="price">Цена:</label>
        <input type="text" id="price" v-model="pizza.price" />
      </div>
      <div>
        <label for="images">Картинка:</label>
        <input type="text" id="images" v-model="pizza.images" />
      </div>
      <div>
        <label for="category">Категория:</label>
        <select id="category" v-model="pizza.id_categories">
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
        </select>
      </div>
      <button class="btn" @click="addPizza">Добавить пицу</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        pizza: {
          title: '',
          description: '',
          size: '',
          price: '',
          images: '',
          id_categories: null,
        },
        categories: [],
      };
    },
    mounted() {
      // Получение списка категорий при загрузке компонента
      this.getCategories();
    },
    methods: {
      getCategories() {
        axios.get('http://localhost/pizza-app/includes/getCategories.php')
          .then(response => {
            if (response.data.success) {
              this.categories = response.data.categories;
            } else {
              console.error('Ошибка при получении списка категорий:', response.data.message);
            }
          })
          .catch(error => {
            console.error('Ошибка при получении списка категорий:', error);
          });
      },
      addPizza() {
        // Отправка запроса на добавление пицы
        axios.post('http://localhost/pizza-app/includes/InsertPizza.php', this.pizza)
          .then(response => {
            if (response.data.success) {
              console.log('Пицца успешно добавлена');
              // Очистка полей ввода после успешного добавления
              this.pizza.title = '';
              this.pizza.description = '';
              this.pizza.size = '';
              this.pizza.price = '';
              this.pizza.images = '';
              this.pizza.id_categories = null;
            } else {
              console.error('Ошибка при добавлении пиццы:', response.data.message);
            }
          })
          .catch(error => {
            console.error('Ошибка при добавлении пиццы:', error);
          });
      },
    },
  };
  </script>
   <style scoped>
   .add-pizza {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 80vh;
    text-align: center;
    width: fit-content;
    border: 1px gray solid;
    border-radius: 5px;
    margin: 0 auto;
    padding: 5px;
  }
  
  .add-pizza h2 {
    margin-bottom: 20px;
  }
  
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  input,
  button,
  textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
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
  
   </style>