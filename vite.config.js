import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        assetsInlineLimit: 0,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/main.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
