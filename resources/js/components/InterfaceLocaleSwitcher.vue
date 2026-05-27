<script setup>
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()

const availableLocales = ['en', 'ru', 'fr']
const currentLocale = route.params.interfaceLocale || 'en'

function changeLocale(newLocale) {
  // Перенаправляем на тот же маршрут, но с новой локалью в URL
  router.push({
    name: route.name,
    params: { ...route.params, interfaceLocale: newLocale },
    query: route.query
  })
}
</script>

<template>
  <select :value="currentLocale" @change="e => changeLocale(e.target.value)">
    <option v-for="loc in availableLocales" :key="loc" :value="loc">{{ loc.toUpperCase() }}</option>
  </select>
</template>
