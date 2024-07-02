import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/front/js/main.js',
                'resources/assets/front/css/main.css',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/front/images/*',
                    dest: 'images'
                },
                {
                    src: 'resources/assets/front/fonts/*',
                    dest: 'fonts'
                }
            ]
        })
    ],
    build: {
        outDir: 'public/assets', // Укажите папку для выходных файлов
        emptyOutDir: false, // Отключение очистки папки назначения перед сборкой
        rollupOptions: {
            input: {
                main_js: resolve(__dirname, 'resources/assets/front/js/main.js'),
                main_css: resolve(__dirname, 'resources/assets/front/css/main.css'),
            },
            output: {
                assetFileNames: 'assets/[name].[hash][extname]',
            },
        },
    },
    assetsInclude: ['**/*.woff', '**/*.woff2', '**/*.eot', '**/*.ttf', '**/*.svg'], // Включение шрифтов в обработку
});
