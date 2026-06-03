import "./bootstrap";
import { createApp } from "vue";
import router from "./router/router";
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'
import App from "./App.vue";
import '../css/admin.css';

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css';

import en from '@lang/en.json'
import ru from '@lang/ru.json'
import ua from '@lang/ua.json'
const messages = {
  en,
  ru,
  ua
}
const i18n = createI18n({
    legacy: false,
    locale: 'en',       // локаль по умолчанию
    fallbackLocale: 'en',
    messages,
})

const vuetify = createVuetify({
  components,
  directives,
  theme: {
    defaultTheme: 'light',
  },
  icons: {
    defaultSet: 'mdi',
  },
});

const app = createApp(App)

const pinia = createPinia()
app.use(pinia)
app.use(i18n)
app.use(vuetify)
app.use(router)
app.mount('#app')
