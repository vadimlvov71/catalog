<template>
  <div class="sidebar">
    <router-link :to="{ name: 'Home', params: { interfaceLocale: interfaceLocale } }" active-class="active">{{ $t('menu.home') }}</router-link>
    <router-link :to="{ name: 'Items', params: { interfaceLocale: interfaceLocale } }" active-class="active">{{ $t('menu.items') }}</router-link>
    <router-link :to="{ name: 'Categories', params: { interfaceLocale: interfaceLocale } }" active-class="active">{{ $t('menu.categories') }}</router-link>
    <router-link to="/settings" active-class="active">Settings</router-link>
    <select @change="changeLang($event.target.value)">
      <option value="en">English</option>
      <option value="ru">Русский</option>
    </select>
    <button class="list-group-item list-group-item-action bg-dark text-white" @click="logout">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </button>
  </div>
</template>






<script setup>
import axios from 'axios';
import { useRoute } from 'vue-router';
import { useI18n } from 'vue-i18n'

const route = useRoute();
const interfaceLocale = route.params.interfaceLocale || 'en';
  //console.log('interfaceLocale', interfaceLocale);
console.log('Текущая локаль в компоненте:', interfaceLocale);

const { locale } = useI18n()
function changeLang(lang) {
  console.log('changeLang', lang);
  locale.value = lang  // переключение языка
}
/*
export default {
  data() {
    return {
      interfaceLocale: 'en'
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
  */
</script>

<style scoped>
.sidebar { width: 250px; display: flex; flex-direction: column; }
.sidebar a { padding: 1rem; text-decoration: none; color: black; }
.sidebar a.active { background-color: #e0e0e0; font-weight: bold; }
</style>