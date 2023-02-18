import Main from "../pages/Main";
import Activities from "../pages/Activities";
import CalendarPage from "../pages/CalendarPage";
import Login from "../components/auth/Login";
import Register from "../components/auth/Register";
import RegisterVerify from "../components/auth/RegisterVerify";
import ProfilePage from "../pages/ProfilePage";
import store from "../store";

import {createRouter, createWebHistory} from "vue-router";
import Page404 from "../pages/Page404";
import PlansPage from "../pages/PlansPage";
import TrainingPage from "../pages/TrainingPage";

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
    {
        path: '/plans',
        component: PlansPage,
        meta: {
            requiresAuth: true
        }
    },
    // {
    //     path: '/activities',
    //     component: Activities
    // },
    {
        path: '/activities/:page(\\d+)*',
        name: 'activities',
        component: Activities,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/profile',
        component: ProfilePage,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/training/view/:id',
        component: TrainingPage,
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
        if (store.getters["auth/isLoggedIn"]) {
            next()
            return
        }
        next('/login')
    } else {
        next()
    }
})

export default router;
