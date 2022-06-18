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
        path: '/dashboard/memberships',
        name: 'dashboard.memberships',
        component: () => import('@/views/dashboard/Memberships.vue')
    },
    {
        path: '/dashboard/members',
        name: 'dashboard.members',
        component: () => import('@/views/dashboard/Members.vue')
    },
    {
        path: '/dashboard/roles',
        name: 'dashboard.roles',
        component: () => import('@/views/dashboard/Roles.vue')
    },
    {
        path: '/dashboard/users',
        name: 'dashboard.users',
        component: () => import('@/views/dashboard/Users.vue')
    },
    {
        path: '/dashboard/subscriptions',
        name: 'dashboard.subscriptions',
        component: () => import('@/views/dashboard/Subscriptions.vue')
    },
    {
        path: '/dashboard/attendances',
        name: 'dashboard.attendances',
        component: () => import('@/views/dashboard/Attendances.vue')
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