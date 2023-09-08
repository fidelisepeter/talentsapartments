// vite.config.js
export default ({ command }) => ({
    base: command === 'serve' ? '' : '/build/',
    publicDir: 'resources/js',
    build: {
        manifest: true,
        outDir: 'build',
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
});