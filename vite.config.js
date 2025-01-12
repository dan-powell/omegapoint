import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
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
