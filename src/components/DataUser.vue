  <script>
  import { computed, ref } from 'vue';
  import { useStore } from '../store/store.js';
  
  export default {
    setup() {
      const Store = useStore()
      const userData = computed(() => ({
        name: Store.name,
        surname: Store.surname,
        email: Store.email
      }));
  
      const saveChanges = () => {
        // Обновление данных пользователя в базе данных
  
        // После успешного сохранения изменений:
        Store.setName(userData.value.name);
        Store.setSurname(userData.value.surname);
        Store.setEmail(userData.value.email);
      }
  
      return {
        userData,
        saveChanges
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
        </div>
        <div>
            <img class="logo" src="../assets/img/signin.png" alt="Пиццерия" title="Пиццерия">
          </div>
    </div>
  </template>
  

  
  <style>
 
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
  .DataUser{
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
  }
  </style>
  