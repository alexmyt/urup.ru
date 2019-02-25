
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//import Quasar from 'quasar-framework/dist/umd/quasar.mat.umd.min';
//import {QLayout,QFab,QFabAction,QBtn,QSearch} from 'quasar-framework/dist/quasar.mat.esm';
//Vue.use(Quasar);

//import Vuetify from 'vuetify';
//Vue.use(Vuetify);

import KeenUI from 'keen-ui';
Vue.use(KeenUI);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.component('header-search', require('./components/HeaderSearch.vue'));
Vue.component('business-search', require('./components/BusinessSearch.vue'));

const app = new Vue({
    el: '#app',
    //data: function () {
    //  return {
    //    version: Quasar.version,
    //    drawerState: true
    //  }
    //},
    components: {
    //    QLayout,QFab,QFabAction,QBtn,QSearch
    },
    //methods: {
    //    launch: function (url) {
    //      Quasar.utils.openURL(url)
    //    }
    //}
});
