import './bootstrap';
import {createApp} from 'vue'

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

// Import Bootstrap
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import App from './app.vue'

// Plugins
import { registerPlugins } from './plugins'
import { registerHelper } from './helper'

const app = createApp(App)

app.config.globalProperties.asset = import.meta.env.VITE_APP_URL
app.use(ElementPlus)
app.use(registerPlugins)
app.use(registerHelper)

app.mount('#app')
