import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  server: {
    proxy: {
      '/api': 'http://localhost' // Проксируем API через Nginx
    },
    host: true, // Позволяет доступ извне контейнера
    port: 5173,
    strictPort: true,
    watch: {
      usePolling: true // Полезно при работе в Docker
    },
    hmr: {
      clientPort: 5173, // Обязательно указываем, иначе Nginx может блокировать WebSocket
      path: '/_vite/' // Должно совпадать с настройкой в Nginx
    }
  }
});