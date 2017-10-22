
<script>
    import moment from 'moment'
    import VdUserAddresses from './addresses.vue'
    import VdAlerts from '../general/alerts.vue'
    export default {
        components: {
            VdUserAddresses,
            VdAlerts
        },
        data () {
            return {
                details: [],
            }
        },
        mounted () {
            this.$http.get('usuarios').then(res => {
                this.$store.commit('USERS_SET_LIST', { users: res.data.users })
            })
            this.$bus.$on('set-user', obj => this.setUser(obj))
        },
        computed: {
            hasUsers () {
                return this.users.length > 0
            },
            users () {
                return this.$store.state.users.list
            },
        },
        methods: {
            setUser (obj) {
                this.users.unshift(obj.user)
            },
            toggle (id) {
                if (id === undefined) {
                    this.toggleAll()
                } else {
                    this.toggleOne(id)
                }
            },
            toggleAll () {
                if (this.details.length > 0) {
                    this.details = []
                } else {
                    this.details = this.users.map(user => {
                        this.$bus.$emit('get-addresses', { userid: user.id })
                        return user.id
                    })
                }
            },
            toggleOne (id) {
                if (this.details.includes(id)) {
                    const index = this.details.indexOf(id)
                    this.details.splice(index, 1)
                } else {
                    this.details.push(id)
                    this.$bus.$emit('get-addresses', { userid: id })
                }
            },
            formatDate (date) {
                return moment(date).format('DD/MM/YYYY')
            },
            edit (user) {
                this.$router.push({ name: 'users.edit', params: { id: user.id } })
            },
            remove (id) {
                const confirm = window.confirm('Tem certeza?!')
                if (confirm) {
                    this.$http.delete(`usuarios/remover/${id}`).then(res => {
                        this.$store.commit('USERS_REMOVE_USER', { id: id })
                        this.$bus.$emit('set-success-msg', { msg: res.data.message })
                    })
                }
            },
        },
    }
</script>

<template>
    <div>
        <h4 v-show="!hasUsers">
            Ainda não há usuários cadastrados!
        </h4>
        <div v-show="hasUsers">
            <vd-alerts></vd-alerts>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">
                            <a href="#" @click.prevent="toggle()">
                                <i class="fa fa-fw" :class="{
                                    'fa-plus-circle green': details.length === 0,
                                    'fa-minus-circle red': details.length > 0
                                }"></i>
                            </a>
                        </th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody v-for="user in users">
                    <tr>
                        <td class="text-center">
                            <a href="#" @click.prevent="toggle(user.id)">
                                <i class="fa fa-fw" :class="{
                                    'fa-plus-circle green': !details.includes(user.id),
                                    'fa-minus-circle red': details.includes(user.id),
                                }"></i>
                            </a>
                        </td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ formatDate(user.created_at) }}</td>
                        <td width="1%" nowrap>
                            [ <a href="#" @click.prevent="edit(user)">editar</a> ]
                             [ <a href="#" @click.prevent="remove(user.id)">excluir</a> ]
                        </td>
                    </tr>
                    <tr v-show="details.includes(user.id)">
                        <td colspan="5">
                            <vd-user-addresses :userid="user.id"></vd-user-addresses>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style>
    .red {
        color: red;
    }
    .green {
        color: green;
    }
</style>