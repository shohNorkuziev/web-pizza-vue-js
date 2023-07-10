<script>
import useCart from '../composables/useCART';
import AddedPizza from './AddedPizza.vue';
import axios from 'axios';
import { useStore } from '../store/store.js'

export default {
  components: { AddedPizza },

  setup() {
    const { getTotalCount, getTotalPrice, items, clearCart } = useCart();
    const store = useStore();

    return {
      items,
      clearCart,
      getTotalCount,
      getTotalPrice,
      success: store.success
    };
  },

  methods: {
     createOrder  ()  {
      const orderData = {
        items: items.value.map(item => ({
          id: item.value.id,
          diameter: item.value.diameter,
          dough: item.value.dough,
          quantity: item.value.quantity,
          title: item.value.title,
          status: 'В обработке',
          all_price: item.price * item.quantity,
          id_user: store.id
        }))
      };

      axios.post('http://localhost/pizza-app/includes/createOrder.php', JSON.stringify(orderData))
        .then(response => {
          if (response.data.success) {
            console.log('Заказ успешно создан');
            // Дополнительная логика после успешного создания заказа
          } else {
            console.error('Ошибка при создании заказа:', response.data.message);
            // Обработка ошибки создания заказа
          }
        })
        .catch(error => {
          console.error('Ошибка при создании заказа:', error);
        });
    },
    redirectToLogin() {
      this.$router.push('/SignIn');
    },
    generateReceipt() {
      const cartData = {
        items: this.items.map(item => ({
          ...item,
          totalPrice: this.getprice(item.id, item.diameter, item.dough)
        })),
        totalPrice: this.getTotalPrice()
      };

      axios
        .post('http://localhost/pizza-app/includes/generateReceipt.php', cartData, {
          headers: {
            'Content-Type': 'application/json',
          },
          responseType: 'blob',
        })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'receipt.pdf');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
          this.createOrder();
        })
        .catch(error => {
          console.error('Ошибка при генерации чека:', error);
          
        });
    },
    getprice(id, diameter, dough) {
      const pizza = this.items.find(
        item => item.id === id && item.diameter === diameter && item.dough === dough
      );
      if (pizza) {
        return pizza.price * pizza.quantity;
      }
      return 0;
    }
  }
};
</script>

<template>
    <div class="wrapper">
        <div class="content">
            <div class="container container--cart">
                    <div class="exist_basket" v-if="items.length === 0">
                            <img src="../assets/img/basket_dog.svg" alt="dog" width="350" />
                            <h2>Пусто!</h2>
                            <p>Вы еще не выбрали пицу, выберите пиццу пожалуйста</p>
                            <router-link to="/" class="button button--outline button--add go-back-btn">
                                <span>Вернуться назад</span>
                            </router-link>
                        </div>
                <div v-else class="cart">
                  
                    <div  class="cart__top">
                        <h2 class="content__title">
                            Корзина</h2>
                        <div class="cart__clear" @click="clearCart">
                            <span>Очистить корзину</span>
                        </div>
                    </div>
                    <!-- // Added pizza -->

                    <AddedPizza v-for="item in items"  :key="item.id" :id="item.id" :price="item.price" :title="item.title"
                        :dough="item.dough" :diameter="item.diameter"></AddedPizza>
                    <div class="cart__bottom">
                        <div class="cart__bottom-details">
                            <span> Всего пицц: <b>{{ getTotalCount() }} шт.</b> </span>
                            <span> Сумма заказа: <b>{{ getTotalPrice() }} ₽</b> </span>
                        </div>
                        <div class="cart__bottom-buttons">
                            <router-link to="/" class="button button--outline button--add go-back-btn">
                                <span>Вернуться назад</span>
                            </router-link>
                            <button v-if="success" @click="generateReceipt" class="button pay-btn">
                                <span>Оплатить сейчас</span>
                            </button>
                              <button v-else @click="redirectToLogin" class="button pay-btn">
                                <span>Оплатить сейчас</span>
                              </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.content__items_basket {
    justify-content: space-between;
}
.exist_basket{
    margin: 0 auto;
    display: grid;
    justify-items: center;
    gap: 20px;
}

</style>