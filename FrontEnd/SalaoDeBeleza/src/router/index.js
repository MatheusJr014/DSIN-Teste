import { createRouter, createWebHistory } from "vue-router";
import GuardUserCliente from '@/services/middleware/AuthUsers';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes:[
        {
            path: '/',
            name: 'home',
            component:()=>import('@/views/Publico/HomeView.vue')
        },
        {
            path: '/login',
            name: 'Login',
            component:()=>import('@/views/Publico/LoginView.vue')
        },
        {
            path:'/user/cliente',
            name: 'UserPage',
            beforeEnter: GuardUserCliente.authUserCliente,
            component:()=>import('@/views/Cliente/ClienteView.vue')
        },
        {
            path: '/user/admin',
            name: 'AdminPage',
            beforeEnter: GuardUserCliente.authUserAdm,
            component:()=>import('@/views/Admin/AdmPerfilView.vue')
        }
    ]
})

export default router 