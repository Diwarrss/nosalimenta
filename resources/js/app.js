require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex'

import store from './store';
//import vue-sweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

//import vue-moment CONFIGURADO AL ESPAÑOL
const moment = require("moment");
require("moment/locale/es");

//import vue2-datepicker
import DatePicker from 'vue2-datepicker';

import 'vue2-datepicker/index.css';
//import vue-select
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
//import vue-validation
import Vue from 'vue'
import Vuelidate from 'vuelidate'

//import element ui
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

//Importar vue-bootstrap
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

//import vue-pagination
Vue.component("pagination", require("laravel-vue-pagination"));

Vue.use(Vuex)
Vue.use(VueSweetalert2);
Vue.use(require("vue-moment"), {
  moment
});
Vue.use(DatePicker)
Vue.component("v-select", vSelect);
Vue.use(Vuelidate)
Vue.use(ElementUI);
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
/* Vue.component('home-admin', require('./views/admin/Home.vue').default); */
Vue.component('home-client', require('./views/client/Home.vue').default);

const app = new Vue({
  el: '#app',
  store: new Vuex.Store(store)
});
