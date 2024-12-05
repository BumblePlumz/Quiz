import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/theme/themeShow.js',
                'resources/js/quiz/dailyQuiz.js',
            ],
            refresh: true,
        }),
    ],
});
