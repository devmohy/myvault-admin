import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path';
import Components from 'unplugin-vue-components/vite';
import { AntDesignVueResolver } from 'unplugin-vue-components/resolvers';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        Components({
          resolvers: [
            AntDesignVueResolver({
              importStyle: false, // css in js
            }),
          ],
        }),
    ],

    resolve: {
        alias: {
          '@' : path.resolve(__dirname, './resources/js'),
          '@assets': path.resolve(__dirname, './resources/assets')
        },
      },
      optimizeDeps: {
        exclude: ['source-map-js','path','url','fs'],
      },

      define: {
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false',
      },
    
});
