import { defineStore } from 'pinia'

export const useContentLocaleStore = defineStore('contentLocale', {
  state: () => ({
    locale: 'en',  // локаль контента по умолчанию
  }),
  actions: {
    setLocale(newLocale) {
      this.locale = newLocale
    }
  }
})
