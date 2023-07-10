import { ref } from "vue";

const items = ref([]);
 export default function useCart() {
  const addPizza = (properties) => {
    const existingPizza = items.value.find(item => item.id === properties.id && item.diameter === properties.diameter && item.dough === properties.dough);
    console.log(items.value)
    if (existingPizza) {
      existingPizza.quantity++;
    } else {
      items.value.push({ ...properties, quantity: 1 });
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

  const   getPizzaCount =(id, diameter ,dough) => {
    const pizza = items.value.find(item => item.id === id && item.diameter === diameter && item.dough === dough);
    return pizza ? pizza.quantity : 0;
  }
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
    getTotalPrice,
    getPizzaCount
  };
}