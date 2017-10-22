
<script>
    import VdUsersTable from './table.vue'
    import VdUserForm from './form.vue'
    export default {
        components: {
            VdUsersTable,
            VdUserForm
        },
        methods: {
            form () {
                this.$router.push({ name: 'users.create' })
            },
        },
    }
</script>

<template>
    <div>
        <h1>
            Gerenciamento de Usuários
            <small>[ <a href="#" @click.prevent="form">criar novo</a> ]</small>
        </h1>
        <router-view></router-view>
        <vd-users-table></vd-users-table>
    </div>
</template>
