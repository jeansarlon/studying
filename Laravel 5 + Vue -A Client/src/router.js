import Vue from 'vue'
import Router from 'vue-router'
import dashboard from './modules/dashboard/routes'
import users from './modules/users/routes'
import addresses from './modules/addresses/routes'
import login from './modules/login/routes'
import store from './store/store'
import { get as localStorageGetItem } from './utils/local'
import axios from 'axios'

Vue.use(Router)

const routes = [].concat(users, addresses, login, dashboard)

const router = new Router({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    const localItem = localStorageGetItem('token')
    if (localItem !== undefined && localItem !== '' && localItem.token !== '') {
        axios.defaults.headers.common['Authorization'] = `Bearer: ${localItem.token}`
        next()
    } else {
        if (to.name !== 'login.index' && store.state.token === '') {
            next({ name: 'login.index' })
        }
        next()
    }
})

export default router