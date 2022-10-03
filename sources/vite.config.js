import { resolve } from "path";

export default {
  root: '',
  base: './',
  build: {
    target: 'ESNext',
    rollupOptions: {
        output: {
            manualChunks: undefined,
            entryFileNames: `assets/[name].js`,
            assetFileNames: "assets/[name].[ext]",
            chunkFileNames: `assets/[name].js`,
        },
    },
  }
}