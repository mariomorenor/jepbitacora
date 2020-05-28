
import Vuex from 'vuex'

require('./bootstrap');
window.Vue = require('vue');
window.Swal = require('sweetalert2');
Vue.use(Vuex)
require('@fortawesome/fontawesome-free/js/all')
Vue.component('sidebar', require('./components/sidebarComponent.vue').default);
Vue.component('main-app', require('./components/App.vue').default);
window.freezeHeader = require('freeze/headerFreeze')
import router from './routes';

const store = new Vuex.Store({
    state: {

    },
    mutations: {
        msgOperacionCorrecta(state){
           
        }
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,

});

