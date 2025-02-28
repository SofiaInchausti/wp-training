import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [react(), tailwindcss()],
    build: {
        manifest: true,
        outDir: 'dist',
        lib: {
            entry: 'src/index.jsx',
            name: 'react-plugin',
            fileName: 'react-plugin',
            formats: ['es'],
        },
        rollupOptions: {
            output: {
                entryFileNames: '[name].mjs',
                chunkFileNames: '[name]-[hash].mjs',
                assetFileNames: '[name]-[hash][extname]',
            },
        },
    },
    server: {
        port: 3334,
        allowedHosts: true,
        cors: true,
    },
});
