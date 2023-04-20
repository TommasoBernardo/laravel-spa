import { createWebHashHistory, createRouter } from "vue-router";

import Home from '../pages/Home';
import Home from '../pages/Register';
import Home from '../pages/Login';
import Home from '../pages/Dashboard';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: routes,
});

export default router;