/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';

Vue.use(VueAxios, axios);

//import TTViewComponent from './components/TTViewComponent.vue';


console.log('before import header component');

import TTAdminProjectIndexComponent from './components/project/TTAdminProjectIndexComponent.vue';
import ClientManagerProjectIndexComponent from './components/project/ClientManagerProjectIndexComponent.vue';
import UserProjectIndexComponent from './components/project/UserProjectIndexComponent.vue';

Vue.component('TTAdminProjectIndexComponent', TTAdminProjectIndexComponent);
Vue.component('ClientManagerProjectIndexComponent', ClientManagerProjectIndexComponent);
Vue.component('UserProjectIndexComponent', UserProjectIndexComponent);

import ClientmanagerMenuitems from './components/menuitems/clientmanager_menuitems_Component.vue';
import UserMenuitems from './components/menuitems/user_menuitems_Component.vue';
import TTAdminMenuitems from './components/menuitems/ttadmin_menuitems_Component.vue';

Vue.component('ClientmanagerMenuitems', ClientmanagerMenuitems);
Vue.component('UserMenuitems', UserMenuitems);
Vue.component('TTAdminMenuitems', TTAdminMenuitems);



import HeaderComponent from './components/HeaderComponent.vue';
Vue.component('HeaderComponent', HeaderComponent);

import ProjectListComponent from './components/ProjectListComponent.vue';
import EntryListComponent from './components/EntryListComponent.vue';
import UserListComponent from './components/UserListComponent.vue';

Vue.component('ProjectListComponent', ProjectListComponent);
Vue.component('EntryListComponent', EntryListComponent);
Vue.component('UserListComponent', UserListComponent);


const routes = [
    {
        name: 'projectlist',
        path: '/projectlist',
        component: ProjectListComponent
    },
    {
        name: 'entrylist',
        path: '/entrylist',
        component: EntryListComponent
    },
    {
        name: 'userlist',
        path: '/userlist',
        component: UserListComponent
    },
   
    ];


const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

