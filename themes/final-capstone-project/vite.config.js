import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [react(), tailwindcss()],
  build: {
    manifest: true,
    outDir: "dist",
    lib: {
      entry: "src/main.jsx",
      name: "react-theme",
      fileName: "react-theme",
      formats: ["es"],
    },
  },
  server: {
    port: 3334,
    allowedHosts: true,
    cors: true,
    strictPort: true,
    hmr: {
      protocol: "ws",
      host: "localhost",
    },
  },
  define: {
    "process.env": {},
  },
});
