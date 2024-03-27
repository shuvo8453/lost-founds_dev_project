// Plugins
import { createPinia } from 'pinia'
import { routers } from '../routers'
import Toaster from '@meforma/vue-toaster'
import { useGlobalStore } from '../stores/global'
import { useAuthStore } from '../stores/auth'

const pinia = createPinia()

export function registerPlugins (app) {
  app
    .use(pinia)
    .use(routers)
    .use(Toaster)
    useGlobalStore()
    useAuthStore()
}
