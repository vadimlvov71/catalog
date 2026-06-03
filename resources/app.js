// resources/app.js

require('./bootstrap');


import { createApp } from 'vue';
import HelloVue from './components/HelloVue.vue';
import '../css/admin.css';

createApp({
    components: {
        HelloVue,
    }
}).mount('#app');