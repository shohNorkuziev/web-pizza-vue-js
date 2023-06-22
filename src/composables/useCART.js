import { ref, computed } from "vue";
 // создаем ссылку на пустой массив
const items = ref([]);
 export default function useCart() {
  // функция добавления пиццы в корзину
  const addPizza = (properties) => {
    items.value.push(properties); // добавляем свойства в массив items
  };
   // функция подсчета количества пицц с определенным id
  const getCountForId = (id) => {
    return items.value.filter((item) => item.id === id).length; // фильтруем массив по id и возвращаем длину полученного массива
  };

   // вычисляемое свойство, которое возвращает количество пицц в корзине
  const count = computed(() => items.value.length);
   // вычисляемое свойство, которое возвращает общую стоимость пицц в корзине
  const price = computed(() =>
    items.value.reduce((total, item) => total + item.price, 0)
  );
  // Очистка корзины
  const clearCart = () =>{
    items.value.splice(0)
  }
   // возвращаем объект с функциями и вычисляемыми свойствами
  return {
    addPizza,
    getCountForId,
    count,
    price,
    items,
    clearCart,
  };
}