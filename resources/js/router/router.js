import Main from "../pages/Main";
import ActivitiesStore from "../pages/ActivitiesStore";
import CalendarPage from "../pages/CalendarPage";
import Login from "../components/Login";
import Register from "../components/Register";
import RegisterVerify from "../components/auth/RegisterVerify";
import store from "../store";

import {createRouter, createWebHistory} from "vue-router";
import Page404 from "../pages/Page404";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/calendar',
        component: CalendarPage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
		name: 'login',
        component: Login
    },
    {
        path: '/register/verify/:token',
        component: RegisterVerify
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    // {
    //     path: '/activities',
    //     component: Activities
    // },
    {
        path: '/activities/:page(\\d+)*',
        name: 'activities',
        component: ActivitiesStore,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: '404',
        component: Page404,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(process.env.BASE_URL)
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

export default router;
