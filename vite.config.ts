import { defineConfig } from "vite";
import usePHP from "vite-plugin-php";

export default defineConfig({
  plugins: [usePHP()],
  server: {
    proxy: {
      "/library": "http://localhost:8000",
    },
  },
});
