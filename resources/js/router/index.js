import { createWebHashHistory, createRouter } from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import Products from '../components/Products';
import EditProducts from '../components/EditProducts';
import AddProducts from '../components/AddProducts';


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
    },
    {
        name: 'products',
        path: '/products',
        component: Products
    },
    {
        name: 'addproducts',
        path: '/products/add',
        component: AddProducts
    },
    {
        name: 'editproducts',
        path: '/products/edit/:id',
        component: EditProducts
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes: routes,
});

export default router;