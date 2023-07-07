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
      <div class="register"></div>
      <div
        class="navbar"
        v-if="componentNumber != 1"
        :class="{ 'no-background': showDropdown }"
      >
        <div class="header__cart">
          <router-link to="/Basket" class="button button--cart">
            <span>{{ getTotalPrice() }} ₽</span>
            <div class="button__delimiter"></div>
            <svg
              width="18"
              height="18"
              viewBox="0 0 18 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <!-- SVG paths -->
            </svg>
            <span>{{ getTotalCount() }}</span>
          </router-link>
        </div>
        <div v-if="!loggedIn">
          <router-link to="/SignIn" class="button button--cart">
            <span>Войти</span>
          </router-link>
        </div>
        <div v-if="loggedIn">
          <span class="button button--cart" @click="showDropdown = !showDropdown">
            Личный кабинет
          </span>
          <div
            v-if="showDropdown"
            class="dropdown-menu show slide-in"
          >
            <ul>
              <li>
                <router-link to="/DataUser">Личные данные</router-link>
              </li>
              <li>
                <router-link to="/">Заказы</router-link>
              </li>
              <li>
                <span @click="logout">Выйти</span>
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
  /* Existing styles */
  position: absolute;
  top: 49px;
  right: 10px;
  width: inhe;
  background-color: #fe5f1e;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
  pointer-events: none;
  z-index: 10;
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
  border-radius: 5px;
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
  position: relative;
}
</style>
