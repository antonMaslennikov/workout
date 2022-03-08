import Main from "../pages/Main";
import Activities from "../pages/Activities";

import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/activities',
        component: Activities
    },
];

const router = createRouter({
   routes,
   history: createWebHistory(process.env.BASE_URL)
});

export default router;
