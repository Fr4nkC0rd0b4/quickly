/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//Components
import router from './router';
import InfiniteLoading from "vue-infinite-loading";
import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuelidate from 'vuelidate'
import Vue from 'vue'
import vSelect from 'vue-select'

//CSS of Components
import 'vue-select/dist/vue-select.css';

//Name Components
Vue.use(InfiniteLoading, { /* options */ });
Vue.use(BootstrapVue)
Vue.use(Vuelidate)
Vue.use(IconsPlugin)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('Infinitiloading', require('vue-infinite-loading'));
Vue.component('scale-loader', require('vue-spinner/src/ScaleLoader.vue').default);
Vue.component('v-select', vSelect)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	router,
    el: '#app',
});
