
<script>
    export default {
        computed: {
            users () {
                return this.$store.state.users.list
            },
        },
    }
</script>

<template>
    <div>
        <h1>Gerenciamento de Endereços</h1>
        <select class="form-control">
            <option :value="user.id" v-for="user in users">{{ user.name }}</option>
        </select>
    </div>
</template>