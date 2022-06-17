import { createApp } from 'vue'
import App from "@/App.vue";
import router from './router/index'
import store from './state/store'

// Imported css file [TailwindCSS Behind the scene]
import './index.css'

//Import flowbite
import 'flowbite/dist/flowbite.js';

createApp(App)
    .use(router)
    .use(store)
    .mount('#app')