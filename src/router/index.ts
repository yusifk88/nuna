import {createRouter, createWebHistory} from '@ionic/vue-router';
import {RouteRecordRaw} from 'vue-router';
import TabsPage from '../views/TabsPage.vue'
import loginPage from "@/views/loginPage.vue";
import signupPage from "@/views/signupPage.vue";
import NewRegistryPage from "@/views/NewRegistryPage.vue";
import profilePage from "@/views/profilePage.vue";
import WeddingPreviewPage from "@/views/WeddingPreviewPage.vue";
import NotificationsPage from "@/views/NotificationsPage.vue"

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
        path: '/profile',
        component: profilePage
    },
    {
        path: '/event/wedding/:id',
        component: WeddingPreviewPage
    },
    {
        path: '/new/:type',
        component: NewRegistryPage
    },
    {
      path:"/notifications",
      component:NotificationsPage
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
