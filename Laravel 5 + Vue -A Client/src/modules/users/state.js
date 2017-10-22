
import { findIndex } from 'lodash'

const state = {
    list: [],
}

const mutations = {
    'USERS_SET_LIST' (state, obj) {
        state.list = obj.users
    },
    'USERS_REMOVE_USER' (state, obj) {
        const index = findIndex(state.list, obj)
        state.list.splice(index, 1)
    },
    'USERS_SET_USER' (state, obj) {
        const index = findIndex(state.list, { id: obj.user.id })
        if (index > -1) {
            state.list.splice(index, 1)
            state.list.splice(index, 0, obj.user)
        } else {
            state.list.unshift(obj.user)
        }
    },
}

export default {
    state, mutations
}