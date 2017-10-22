
<script>
    import { set as localStorageSetItem, get as localStorageGetItem } from './utils/local'
    import { mapState } from 'vuex'
    export default {
        name: 'App',
        computed: {
            shouldShowNav () {
                return this.$route.name !== 'login.index'
            },
            ...mapState({
                user (state) {
                    if (state.user.name === undefined) {
                        return localStorageGetItem('user').user
                    }
                    return state.user
                },
            })
        },
        methods: {
            logout () {
                this.$store.commit('SET_TOKEN', { token: '' })
                this.$store.commit('SET_USER', { user: {} })
                localStorageSetItem('token', { token: '' })
                localStorageSetItem('user', { user: '' })
                this.$router.push({ name: 'login.index' })
            },
        },
    }
</script>

<template>
    <div class="container">
        <div class="well" v-show="shouldShowNav">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>
                            <router-link :to="{ name: 'dashboard.index' }">Dashboard</router-link>
                            <router-link :to="{ name: 'users.index' }">Usuários</router-link>
                            <router-link :to="{ name: 'addresses.index' }">Endereços</router-link>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-right">
                    Usuário: <strong>{{ user.name }}</strong>
                    [ <a href="#" @click.prevent="logout">logout</a> ]
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
</template>

<style>
    ul, li {
        display: inline-block;
    }
    li a {
        margin-right: 15px;
    }
    .router-link-active {
        color: red;
    }
</style>