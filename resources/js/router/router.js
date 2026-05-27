import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../pages/HomeVue.vue"
import ItemsView from '../pages/items/ItemsView.vue'
import ItemsCreateView from '../pages/items/ItemsCreateView.vue'
import CategoriesView from '../pages/categories/CategoriesView.vue'


// импорт других компонентов

const routes = [
  {
    path: '/manager_secret/:interfaceLocale',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/manager_secret/:interfaceLocale/items',
    name: 'Items',
    component: ItemsView
  },
  {
    path: '/manager_secret/:interfaceLocale/categories',
    name: 'Categories',
    component: CategoriesView
  },
  {
    path: '/manager_secret/:interfaceLocale/settings',
    name: 'Settings',
    component: ItemsView
  },
  // другие маршруты с параметром :locale
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Навигационный охранник для проверки и перезаписи локали
router.beforeEach((to, from, next) => {
  const supportedLocales = ['en', 'ru', 'fr']  // список поддерживаемых локалей
  const interfaceLocale = to.params.interfaceLocale
  console.log('interfaceLocale: ' + interfaceLocale);
  console.log('fullPath' + to.fullPath);
  if (!interfaceLocale || !supportedLocales.includes(interfaceLocale)) {
    // редирект на локаль по умолчанию
    //return next({ path: `/en${to.fullPath}` })
  }
  next()
})

export default router


