import { defineConfig, loadEnv } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

const env = loadEnv('', '');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/shared.css',
                'resources/js/shared.js',
                'resources/css/home.css',
                'resources/js/home.js',
                'resources/css/news.css',
                'resources/js/news.js'
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    server: {
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,
        origin: `${process.env.DDEV_PRIMARY_URL_WITHOUT_PORT}:5173`,
        cors: {
            origin: /https?:\/\/([A-Za-z0-9\-\.]+)?(\.ddev\.site)(?::\d+)?$/,
        },
        watch: {
            ignored: [
                '**/storage/**',
                '**/Filament/**',
            ],
        },
    },
    css: {
        devSourcemap: true
    },
});
