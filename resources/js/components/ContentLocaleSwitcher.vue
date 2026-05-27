<script setup>
import { useContentLocaleStore } from '@/stores/contentLocale'

const contentLocaleStore = useContentLocaleStore()
const availableLocales = ['en', 'ru', 'fr']
const currentLocale = contentLocaleStore.locale

function changeContentLocale(newLocale) {
  contentLocaleStore.setLocale(newLocale)
}
</script>

<template>
  <select :value="currentLocale" @change="e => changeContentLocale(e.target.value)">
    <option v-for="loc in availableLocales" :key="loc" :value="loc">{{ loc.toUpperCase() }}</option>
  </select>
</template>
