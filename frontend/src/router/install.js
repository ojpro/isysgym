const install = [
    {
        path: '/install',
        name: 'install.start',
        component: () => import('../views/install/Index.vue'),
        children: []
    },
    {
        path: '/install/database',
        name: 'install.database',
        component: () => import('../views/install/Database.vue'),
    },
    {
        path: '/install/gym',
        name: 'install.gym',
        component: () => import('../views/install/GYM.vue'),
    },
    {
        path: '/install/admin',
        name: 'install.admin',
        component: () => import('../views/install/Admin.vue'),
    },
    {
        path: '/install/completed',
        name: 'install.completed',
        component: () => import('../views/install/Completed.vue'),
    }
]
export default install[0]