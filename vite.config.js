import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

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
        port: 80,
        hmr: {
            host: 'node.omegapoint.lndo.site',
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
    }
});
