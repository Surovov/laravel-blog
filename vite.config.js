import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/admin/main.js',
                // 'resources/assets/admin/main.css',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/admin/dist/img/*',
                    dest: 'img'
                }
            ]
        })
    ],
    base: '/blog/', // Укажите базовый URL, соответствующий вашей поддиректории
    build: {
        outDir: 'public/build', // Укажите папку для выходных файлов
        emptyOutDir: false, // Отключение очистки папки назначения перед сборкой
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'resources/assets/admin/main.js'),
                style: resolve(__dirname, 'resources/assets/admin/main.css'),
            },
            output: {
                assetFileNames: 'assets/[name].[hash][extname]',
            },
        },
    },
    assetsInclude: ['**/*.woff', '**/*.woff2', '**/*.eot', '**/*.ttf', '**/*.svg'], // Включение шрифтов в обработку
});
