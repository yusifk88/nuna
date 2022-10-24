import {createRouter, createWebHistory} from '@ionic/vue-router';
import {RouteRecordRaw} from 'vue-router';
import TabsPage from '../views/TabsPage.vue'
import loginPage from "@/views/loginPage.vue";
import signupPage from "@/views/signupPage.vue";
import NewRegistryPage from "@/views/NewRegistryPage.vue"

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        redirect: '/tabs/tab1'
    },
    {
        path: '/login',
        component: loginPage
    },
    {
        path: '/register',
        component: signupPage
    },
    {
        path: '/event/wedding/:id',
        component: () => import("@/views/WeddingPreviewPage.vue")
    },
    {
        path: '/new/:type',
        component: NewRegistryPage
    },
    {
        path: '/tabs/',
        component: TabsPage,
        children: [
            {
                path: '',
                redirect: '/tabs/tab1'
            },
            {
                path: 'tab1',
                component: () => import('@/views/Tab1Page.vue')
            },
            {
                path: 'tab2',
                component: () => import('@/views/Tab2Page.vue')
            },
            {
                path: 'tab3',
                component: () => import('@/views/Tab3Page.vue')
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
