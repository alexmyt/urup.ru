
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//require('quasar-framework/dist/quasar.mat.css');
//require('quasar-extras/roboto-font');
//import Quasar from 'quasar-framework';
//import router from './router';

//Vue.use(Quasar);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.component('header-search', require('./components/HeaderSearch.vue'));
Vue.component('business-search', require('./components/BusinessSearch.vue'));

const app = new Vue({
    el: '#app'
});
