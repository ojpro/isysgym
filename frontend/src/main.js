import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index'
import store from './state/store'

// Imported css file [TailwindCSS Behind the scene]
import './index.css'

//import flowbite
import 'flowbite'

createApp(App)
    .use(router)
    .use(store)
    .mount('#app')