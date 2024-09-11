import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss', // Add SCSS file here
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
