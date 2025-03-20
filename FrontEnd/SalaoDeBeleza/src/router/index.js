import { createRouter, createWebHistory } from "vue-router";

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
            component:()=>import('@/components/Publico/LoginComponents.vue')
        },
        {
            path:'/user/cliente',
            name: 'UserPage',
            component:()=>import('@/views/Cliente/ClienteView.vue')
        },
        {
            path: '/user/admin',
            name: 'AdminPage',
            component:()=>import('@/views/Admin/AdmPerfilView.vue')
        }
    ]
})

export default router 