import axios from 'axios'
import { set as localStorageSetItem } from '../utils/local'

export default {
    'SET_TOKEN' (state, obj) {
        axios.defaults.headers.common['Authorization'] = `Bearer: ${obj.token}`
        localStorageSetItem('token', { token: obj.token })
        state.token = obj.token
    },
    'SET_USER' (state, obj) {
        state.user = obj.user
        localStorageSetItem('user', { user: obj.user })
    }
}