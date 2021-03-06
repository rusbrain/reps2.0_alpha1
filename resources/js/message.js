


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');


/**
 * Axios init
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


/**
 * Vue js init
 */
window.Vue = require('vue');

const Vue2TouchEvents = require('vue2-touch-events');

window.VueSocketio = require('vue-socket.io');
Vue.use(Vue2TouchEvents);

window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

// import textarea auto-resize package
window.VueTextareaAutosize = require('vue-textarea-autosize') 
Vue.use(VueTextareaAutosize)

Vue.component('chat', require('./components/ChatRoom/index.vue').default);
Vue.config.productionTip = false;

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

var app = new Vue({
    el: '#chatroom',
});

