import { createApp } from "vue/dist/vue.esm-browser.prod";
import ContentGenerator from './components/ContentGenerator.vue'

const app = createApp({});
app.component('content-generator', ContentGenerator);

app.mount('#app');

