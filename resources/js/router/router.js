import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../Pages/HomeVue.vue"
import ItemsView from '../Pages/Items/ItemsView.vue'
import ItemsCreateView from '../Pages/Items/ItemsCreateView.vue'
import CategoriesView from '../Pages/CategoriesView.vue'

const routes = [
    {
        path: '/manager_secret/:locale', 
        name: 'Home',
        component: HomeView 
    },
    {
        path: '/manager_secret/:locale/items',
        name: 'Items',
        component: ItemsView
    },
   
    { path: '/items', component: ItemsView },
    { path: '/items/create', component: ItemsCreateView },
    { path: '/categories', component: CategoriesView },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});

