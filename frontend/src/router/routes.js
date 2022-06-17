//TODO: separate common routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('@/views/Home.vue')
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('@/views/dashboard/Dashboard.vue')
    },
    {
        path: '/blank',
        name: 'blank',
        component: () => import('@/views/dashboard/Blank.vue')
    },
    {
        path: '/install',
        name: 'install.start',
        //TODO: use @ notation for import path
        component: () => import('../views/install/Index.vue'),
        meta: {
            install: true
        }
    },
    {
        path: '/install/database',
        name: 'install.database',
        component: () => import('../views/install/Database.vue'),
        meta: {
            install: true
        }
    },
    {
        path: '/install/gym',
        name: 'install.gym',
        component: () => import('../views/install/GYM.vue'),
        meta: {
            install: true
        }
    },
    {
        path: '/install/admin',
        name: 'install.admin',
        component: () => import('../views/install/Admin.vue'),
        meta: {
            install: true
        }
    },
    {
        path: '/install/completed',
        name: 'install.completed',
        component: () => import('../views/install/Completed.vue'),
        meta: {
            install: true
        }
    }
]

export default routes