import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/client/chat-support.js',
                'resources/js/admin/chat-support.js',
            ],
            refresh: true,
        }),
    ],
});
