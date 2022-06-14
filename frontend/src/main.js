import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// Imported css file [TailwindCSS Behind the scene]
import './index.css'

//import flowbite
import 'flowbite'

createApp(App)
    .use(router)
    .use(store)
    .mount('#app')