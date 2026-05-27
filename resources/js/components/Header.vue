<template>
  <div>
    
    <!-- Здесь выводим содержимое с учётом contentLocale -->
  </div>
</template>

<script setup>
import InterfaceLocaleSwitcher from '@/components/InterfaceLocaleSwitcher.vue'
import ContentLocaleSwitcher from '@/components/ContentLocaleSwitcher.vue'
import { useContentLocaleStore } from '@/stores/contentLocale'
import { watch } from 'vue'
import axios from 'axios'

const contentLocaleStore = useContentLocaleStore()
const contentLocale = contentLocaleStore.locale
//const items = ref([])

async function fetchItems() {
  const response = await axios.get(`/api/items?content_locale=${contentLocaleStore.locale}`)
  items.value = response.data
}
/*

watch(() => contentLocaleStore.locale, fetchItems, { immediate: true })
*/
</script>
