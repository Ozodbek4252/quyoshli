import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue2";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/vendor.css",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm.js",
        },
    },
});
