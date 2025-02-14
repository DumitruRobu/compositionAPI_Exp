import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: () => import('../js/components/HomeComponent.vue')
        },
        {
            path: '/all',
            name: 'All',
            component: () => import('../js/components/AllComponent.vue')
        },
        {
            path: '/edit/:id',
            name: 'EditPerson',
            component: () => import('../js/components/EditComponent.vue')
        },
    ]
})
export default router
