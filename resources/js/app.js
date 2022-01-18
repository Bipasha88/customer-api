require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import App from "./components/App";
import AllCustomers from "./components/AllCustomers";
import SingleCustomer from "./components/SingleCustomer";
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'home',
            path: '/',
            component: AllCustomers
        },
        {
            name: 'customer',
            path: '/:id',
            component: SingleCustomer
        }
    ],
});
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
