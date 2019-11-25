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




import TTViewComponent from './components/TTViewComponent.vue';
import EntryComponent from './components/EntryComponent.vue';
import UserComponent from './components/UserComponent.vue';
import HopeComponent from './components/HopeComponent.vue';

import HeaderComponent from './components/HeaderComponent.vue';

import ProjectListComponent from './components/ProjectListComponent.vue';
import UserViewComponent from './components/UserViewComponent.vue';


Vue.component('TTViewComponent', TTViewComponent);
Vue.component('HeaderComponent', HeaderComponent);
Vue.component('ProjectListComponent', ProjectListComponent);
Vue.component('UserViewComponent', UserViewComponent);


const routes = [
  {
      name: 'defaultuserview',
      path: '/',
      component: UserViewComponent
  },
  {
      name: 'entry',
      path: '/entry',
      component: EntryComponent
  },
  {
      name: 'user',
      path: '/user',
      component: UserComponent
  },
  {
    name: 'hope',
    path: '/hope',
    component: HopeComponent
    },    
    {
        name: 'projectlistcomponent',
        path: '/projectlistcomponent',
        component: ProjectListComponent
    },
    
    ];


const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

