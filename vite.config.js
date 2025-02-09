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
        https: false,
        host: true,
        port: env.VITE_PORT ?? 80,
        hmr: {
            host: env.VITE_HOST ?? 'localhost',
            protocol: 'ws'
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
