import { ref } from "vue";
 // создаем ссылку на пустой массив
const items = ref([]);
 export default function useCart() {
  // функция добавления пиццы в корзину
  const addPizza = (properties) => {
    const existingPizza = items.value.find(item => item.id === properties.id && item.diameter === properties.diameter && item.dough === properties.dough);
  
    if (existingPizza) {
      existingPizza.quantity++; // Увеличиваем количество пиццы
    } else {
      items.value.push({ ...properties, quantity: 1 }); // Добавляем новую пиццу с начальным количеством 1
    }
  };

  const getTotalCount = () => {
    return items.value.reduce((total, item) => total + item.quantity, 0);
  };

  const getTotalPrice = () => {
    return items.value.reduce(
      (total, item) => total + item.price * item.quantity,
      0
    );
  };
  const clearCart = () =>{
    items.value.splice(0)
  }

  const removePizza=(id, diameter , dough)=>{
    const index = items.value.findIndex(item => item.id === id && item.diameter === diameter && item.dough === dough);
    if (index !==-1){
      items.value.splice(index,1)
    }
  }

  return {
    addPizza,
    items,
    clearCart,
    removePizza,
    getTotalCount,
    getTotalPrice
  };
}