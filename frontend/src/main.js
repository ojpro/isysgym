import { createApp } from 'vue'
import App from "@/App.vue";
import router from './router/index'
import store from './state/store'
import LitepieDatepicker from 'litepie-datepicker';

// Imported css file [TailwindCSS Behind the scene]
import './index.css'

//Import flowbite
import 'flowbite/dist/flowbite.js';

createApp(App)
    .use(router)
    .use(store)
    .use(LitepieDatepicker)
    .mount('#app')