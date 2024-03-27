import { createRouter, createWebHistory } from 'vue-router'


const routes = [
      {
        path: '/',
        name: 'welcome',
        meta: {
          title: 'welcome',
        },
        component: () => import(/* webpackChunkName: "welcome" */'../views/welcome/index.vue'),
    },
    {
        path: '/login',
        name: 'login',
        meta: {
          title: 'Login',
          redirectIfAuthenticated: true,
        },
        component: () => import(/* webpackChunkName: "Login" */'../views/auth/login.vue'),
    },
    {
        path: '/registation',
        name: 'registation',
        meta: {
          title: 'Registation',
          redirectIfAuthenticated: true,
        },
        component: () => import(/* webpackChunkName: "registation" */'../views/auth/registation.vue'),
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        meta: {
          title: 'Welcome',
          requireAuth: true,
        },
        component: () => import(/* webpackChunkName: "dashboard" */'../views/dashboard/index.vue'),
    },

    {
      path: '/item/create',
      name: 'item',
      meta: {
        title: 'Item',
        requireAuth: true,
      },
      component: () => import(/* webpackChunkName: "item" */'../views/item/create.vue'),
  },
    
  
]

function setTitle (title) {
    document.title = title ? title + ' | ' + import.meta.env.VITE_APP_NAME : import.meta.env.VITE_APP_NAME ?? 'Ba Task'
}

const token = () => {
    return localStorage.getItem('token') ?? ''
}

const clearToken = () => {
    localStorage.removeItem('token')
    localStorage.removeItem('profile')
}

export const routers = createRouter({
    history: createWebHistory(),
    routes
  })

routers.beforeEach((to, from, next) => {
    if (to.meta.title) {
      setTitle(to.meta.title)
    }

    if (to.meta.requireAuth) {
        let accessToken = token()
        if (accessToken) {
            axios.get('/api/v1/me', {
            headers: {Authorization: `Bearer ${accessToken}`}
            }).then((res) => {
                localStorage.setItem('profile', JSON.stringify(res.data.profile))
            }).catch(err => {
            if (err.response.status === 401) {
                clearToken()
                next({ name: 'login' })
            }
            })
        } else {
            next({ name: 'login' })
        }
    }

    if (to.meta.redirectIfAuthenticated) {
      if(token()){next({ name: 'dashboard' })}
    }

    next()
  })

