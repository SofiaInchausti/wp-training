import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [react(), tailwindcss()],
  //   base: '/wp-content/plugins/my_custom_plugin/',
  build: {
    manifest: true,
    outDir: "dist",

    lib: {
      entry: "src/index.jsx",
      name: "react-plugin",
      fileName: "react-plugin",
    },
  },
  server:{
    port:3334,
    allowedHosts: true,
    cors: true,
  }
});
