<template>
  
    
  <v-layout class="rounded rounded-md border">
    <v-app-bar title="Application bar"><Header /></v-app-bar>

    <v-navigation-drawer>
      <v-list nav>
        <v-list-item title="Navigation drawer" link>
          <Sidebar />
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main class="d-flex align-center justify-center" >
      <v-container>
        <v-sheet
        
          color="surface-light"
         
          margin-top="200"
          rounded="lg"
          width="100%"
        > 
        <RouterView />
      </v-sheet>
      </v-container>
    </v-main>
  </v-layout>
</template>

<script setup>
import en from '@lang/en.json'
import ru from '@lang/ru.json'
import { ref, onMounted } from 'vue'
import Sidebar from './components/Sidebar.vue'
import Header from './components/Header.vue'

const messages = {
  en,
  ru
}
const isCollapsed = ref(false)
//const locale = ref(window.appData?.locale || 'en')

onMounted(() => {
  //console.log('Текущая локаль:', locale.value)
})
</script>


<style scoped>
.layout {
  display: flex;
  min-height: 100vh;
}

.sidebar {
  width: 250px;
  background: #2c3e50;
  color: white;
  transition: width 0.3s;
}

.sidebar.collapsed {
  width: 60px;
}

.sidebar-header {
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.toggle-btn {
  background: none;
  border: none;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
}

.sidebar-nav {
  display: flex;
  flex-direction: column;
}

.nav-item {
  padding: 1rem;
  color: white;
  text-decoration: none;
  transition: background 0.2s;
}

.nav-item:hover {
  background: rgba(255,255,255,0.1);
}

.nav-item.router-link-active {
  background: rgba(255,255,255,0.2);
}

.main-content {
  flex: 1;
  padding: 2rem;
}

@media (max-width: 768px) {
  .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    z-index: 1000;
    transform: translateX(-100%);
  }

  .sidebar:not(.collapsed) {
    transform: translateX(0);
  }
}
</style>
