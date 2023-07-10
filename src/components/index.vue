<script>
import Pizza from './Pizza.vue';
import { ref } from 'vue';
import axios from 'axios';

export default {
  components: { Pizza },

  setup() {
    const pizzas = ref([])

    axios.get('http://localhost/pizza-app/includes/Pizza.php')
      .then(response => { 
        pizzas.value = response.data;
      })
      .catch(error => { console.log(error) })

    const handleAnchorClick = (event, id) => {
      event.preventDefault();
      const element = document.getElementById(id);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    }

    return {
      pizzas,
      handleAnchorClick
    }
  },
}
</script>

<template>
  <div class="content">
    <div class="container">
      <div class="content__top">
        <div class="categories">
          <ul>
            <li @click="handleAnchorClick($event, 'Pizza')"><a href="#Pizza" >Пицца</a></li>
            <li @click="handleAnchorClick($event, 'Drinks')"><a href="#Drinks" >Напитки</a></li>
          </ul>
        </div>
      </div>
      <h2 class="content__title" id="Pizza">Пицца</h2>
      <div class="content__items">
        <Pizza class="pizza" v-for="pizza in pizzas" :key="pizza.id" :id="pizza.id" :price="pizza.price" :title="pizza.title" />
      </div>
      <h2 class="content__title" id="Drinks">Напитки</h2>
      <div class="content__items">
        <Pizza class="pizza" v-for="pizza in pizzas" :key="pizza.id" :id="pizza.id" :price="pizza.price" :title="pizza.title" />
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
