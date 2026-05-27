import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'
/*
export default defineConfig({
    server: {
        port: 5175,
        host: '0.0.0.0' ,// Allow external connections
        hmr: {
            host: 'localhost',
        },
        cors: {
            origin: false, // disable CORS
    },

    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});*/
export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
     vue(),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
      '@lang': path.resolve(__dirname, 'resources/lang_json')
    }
  },
  server: {
    host: '0.0.0.0',  // Listen on all interfaces
    port: 5175,
    cors: true,               // разрешить CORS
    strictPort: true,
    hmr: {
      host: 'localhost',  // Use container's network IP
      port: 5175,
    }
  }
})
