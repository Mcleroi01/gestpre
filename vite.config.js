import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],

    server: {
        host: "10.252.252.47",
        cors: {
            origin: "*",
            credentials: true, // Enable CORS
        },
    },
});
