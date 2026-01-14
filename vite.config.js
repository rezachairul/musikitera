// vite.config.js

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: "0.0.0.0",
        port: Number(process.env.VITE_PORT) || 3000,
        strictPort: true,
        hmr: {
            host: "localhost",
            port: 3000,
        },
    },
    build: {
        sourcemap: false,
    },
});
