<script>
export default {
  // Логика компонента
}
</script>

<template>
    <div class="admin-panel">
      <h2>Админ панель</h2>
      <div class="admin-panel__links">
        <router-link to="/EditUser">Управление данными пользователя</router-link>
        <router-link to="/EditPizza">Управление пиццами</router-link>
      </div>
    </div>
  </template>

  <style scoped>
  .admin-panel {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 75vh;
  }
  
  .admin-panel h2 {
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .admin-panel__links {
    display: flex;
    flex-direction: column;
    align-items: center;
    counter-reset: admin-link-counter;
  }
  
  .admin-panel__links a {
    margin-bottom: 10px;
    position: relative;
  }
  
  .admin-panel__links a::before {
    content: counter(admin-link-counter);
    counter-increment: admin-link-counter;
    position: absolute;
    left: -25px;
    top: 50%;
    transform: translateY(-50%);
    font-weight: bold;
  }
  .admin-panel__links a::after {
    content: "";
    position: absolute;
    left: -25px;
    top: 50%;
    transform: translateY(-50%);
    width: 10px;
    height: 10px;
    background-color: gray;
    opacity: 0.7;
    border-radius: 50%;
  }
  </style>