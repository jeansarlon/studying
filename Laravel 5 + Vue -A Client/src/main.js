window.jQuery = window.$ = require('jquery')
require('bootstrap')

import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import Eventbus from './plugins/eventbus'
import router from './router'
import store from './store/store'

Vue.use(Eventbus)

var http = axios.create({
  baseURL: 'http://localhost:8000/api/',
});

Vue.prototype.$http = http

new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
})
