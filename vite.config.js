import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    test: {
        globals: true, // Mengaktifkan API global seperti `describe`, `it`, dll.
        environment: 'jsdom', // Gunakan jsdom untuk simulasi DOM
    },
});
