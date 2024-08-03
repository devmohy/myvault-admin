import './bootstrap';
import 'flowbite';
import 'flowbite-datepicker';
import 'flowbite/dist/datepicker.turbo.js';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import Multiselect from "@vueform/multiselect";
import '@vueform/multiselect/themes/default.css'
import 'primeicons/primeicons.css'
import PrimeVue from "primevue/config"; 
import Panel from "primevue/panel";
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';
import 'ant-design-vue/dist/reset.css';
import { InstallCodemirro } from "codemirror-editor-vue3";

import ApexCharts from 'vue3-apexcharts'
const globalOptions = {
  mode: 'auto',
};
import { createPinia } from 'pinia';
import router from './routes/index';
const app = createApp({});
const pinia = createPinia();
app.use(VueTailwindDatepicker);
app.use(Toast)
app.component('Multiselect', Multiselect)
app.component("Panel", Panel);
app.component('apexchart', ApexCharts);
app.use(InstallCodemirro, { componentName: "Code" });
app.use(VueTelInput, globalOptions);
app.use(pinia);
app.use(router)
app.mount('#app')
