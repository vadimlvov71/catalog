<template>
  <div class="sidebar">
    <router-link :to="{ name: 'Home', params: { locale: locale } }" active-class="active">Home</router-link>
    <router-link :to="{ name: 'Items', params: { locale: locale } }" active-class="active">Items</router-link>
    <router-link to="/categories" active-class="active">Categories</router-link>
    <router-link to="/settings" active-class="active">Settings</router-link>
    <button class="list-group-item list-group-item-action bg-dark text-white" @click="logout">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </button>
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      locale: 'en'
    }
  },
  methods: {
    logout() {
      axios.post('/logout', {}, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(() => {
        window.location.href = '/login'; // Перенаправление после выхода
      })
      .catch(() => {
        alert('Ошибка выхода');
      });
    }
  }
}
</script>

<style scoped>
.sidebar { width: 250px; display: flex; flex-direction: column; }
.sidebar a { padding: 1rem; text-decoration: none; color: black; }
.sidebar a.active { background-color: #e0e0e0; font-weight: bold; }
</style>