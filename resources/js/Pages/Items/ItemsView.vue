<template>
  <div>
    <button @click="handleClick">Нажми меня</button>
    <h2>Список товаров:</h2>
    <ul>
      <li v-for="item in items" :key="item.id">
        <h3> {{ item.name }}</h3>
        <p>Описание: {{ item.description }}</p>
        <p>Цена: {{ item.price }} руб.</p>
        <p>Статус: {{ item.status }}</p>
        <!-- Если есть изображение, можно показать -->
        <img v-if="item.image" :src="item.image" alt="Изображение товара" />
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      items: []  // сюда подгрузятся данные
    };
  },
  mounted() {
    fetch('/api/manager_secret/en/json/items') // URL вашего Laravel контроллера (приведите к вашему маршруту)
      .then(response => response.json())
      .then(data => {
        if(data.status === 'success'){
          this.items = data.items; // в items приходит массив товаров
        } else {
          console.error('Ошибка при получении данных');
        }
      })
      .catch(error => {
        console.error('Ошибка сети или сервера', error);
      });
  },
  methods: {
      handleClick() {
          this.$router.push('/items/create'); // путь маршрута Vue Router
      }
    }
};
</script>


