
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from "vue-router";
Vue.use(VueRouter);
import Myheader from './components/Myheader';
import Myfooter from "./components/Myfooter";
import routes from "./routes";


const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router,
    components:{
        Myheader,
        Myfooter,
    }
});
