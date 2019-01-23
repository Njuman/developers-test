require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import HomePage from './components/company/HomePage'
import CompanyPage from './components/company/CompanyPage'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/new',
            name: 'new',
            component: CompanyPage
        },
        {
            path: '/view/:id',
            name: 'view',
            component: CompanyPage
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
