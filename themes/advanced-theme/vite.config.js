import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import tailwindcss from '@tailwindcss/vite'

// https://vite.dev/config/
export default defineConfig({
  plugins: [react(), tailwindcss()],
  build: {
    manifest: true, // Genera el manifest.json
    outDir: "dist",
    rollupOptions: {
      input: "src/main.jsx", // Define el punto de entrada
    },
  },
})
