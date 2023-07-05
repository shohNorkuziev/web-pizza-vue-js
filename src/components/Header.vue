<script>
import { computed, ref } from 'vue';
import useCart from '../composables/useCART';
import router from '../router';
import { useStore } from '../store/store';

export default {
  setup() {
    const Store = useStore()
    const loggedIn = computed(() => Store.success)
    const { getTotalCount, getTotalPrice, items } = useCart()
    const showDropdown = ref(false)

    const logout = () => {
      Store.success = false;
      Store.role = '';
      Store.name = '';
      Store.surname = '';
      Store.id = '';
      Store.email = '';
      router.push({ name: 'SignInVue' })
    }

    return {
      items,
      getTotalCount,
      getTotalPrice,
      loggedIn,
      showDropdown,
      logout
    }
  },
  computed: {
    componentNumber() {
      switch (this.$route.name) {
        case 'SignInVue': return '1';
        case 'SignUpVue': return '1';
        default:
          return '';
      }
    },
  },
}
</script>

<template>
  <div class="header">
    <div class="container">
      <router-link to="/">
        <div class="header__logo">
          <img width="38" src="../assets/img/pizza-logo.svg" alt="Pizza logo" />
          <div>
            <h1>VUE Pizza</h1>
            <p>самая вкусная пицца во вселенной</p>
          </div>
        </div>
      </router-link>
      <div class="register">
      </div>
      <div class="navbar" v-if="componentNumber != 1">
        <div class="header__cart">
          <router-link to="/Basket" class="button button--cart">
            <span>{{ getTotalPrice() }} ₽</span>
            <div class="button__delimiter"></div>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M6.33333 16.3333C7.06971 16.3333 7.66667 15.7364 7.66667 15C7.66667 14.2636 7.06971 13.6667 6.33333 13.6667C5.59695 13.6667 5 14.2636 5 15C5 15.7364 5.59695 16.3333 6.33333 16.3333Z"
                stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M14.3333 16.3333C15.0697 16.3333 15.6667 15.7364 15.6667 15C15.6667 14.2636 15.0697 13.6667 14.3333 13.6667C13.597 13.6667 13 14.2636 13 15C13 15.7364 13.597 16.3333 14.3333 16.3333Z"
                stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M4.78002 4.99999H16.3334L15.2134 10.5933C15.1524 10.9003 14.9854 11.176 14.7417 11.3722C14.4979 11.5684 14.1929 11.6727 13.88 11.6667H6.83335C6.50781 11.6694 6.1925 11.553 5.94689 11.3393C5.70128 11.1256 5.54233 10.8295 5.50002 10.5067L4.48669 2.82666C4.44466 2.50615 4.28764 2.21182 4.04482 1.99844C3.80201 1.78505 3.48994 1.66715 3.16669 1.66666H1.66669"
                stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>{{ getTotalCount() }}</span>
          </router-link>
        </div>
        <div v-if="!loggedIn" class="authoriz">
          <router-link to="/SignIn" class="button button--cart">
            <span>Войти</span>
          </router-link>
        </div>
        <div v-if="loggedIn" class="authoriz">
          <button class="button button--cart" @click="showDropdown = !showDropdown">
            <span>Личный кабинет</span>
          </button>
          <div v-if="showDropdown" class="dropdown-menu show">
            <ul>
              <li>
                <router-link to="/">
                  Личные данные
                </router-link>
              </li>
              <li>
                <router-link to="/">
                  Заказы
                </router-link>
              </li>
              <li>
                <span @click="logout">выйти</span>
              </li>
            </ul>
          </div>
        </div>
      </div>


    </div>
  </div>
</template>

<style scoped>
.dropdown-menu {
  position: absolute;
  top: 139px;
  left: 1080px;
  width: 150px;
  background-color: #fe5f1e;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 1s ease, transform 1s ease;
  pointer-events: none;
}

.dropdown-menu.show {
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.dropdown-menu ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.dropdown-menu li {
  padding: 10px;
  transition: background-color 0.3s ease;
  cursor: pointer;
}

.dropdown-menu li:hover {
  background-color: #f24701;
  border-radius: 4px;
}

.dropdown-menu a {
  text-decoration: none;
  color: #ffffff;
}
.dropdown-menu span {
  text-decoration: none;
  color: #ffffff;
}
.navbar {
  display: flex;
  flex-direction: row;
  gap: 15px;
}
</style>