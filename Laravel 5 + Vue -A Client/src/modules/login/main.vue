
<script>
    export default {
        data () {
            return {
                email: 'vedovelli@gmail.com',
                password: '123456',
            }
        },
        methods: {
            submit () {
                this.$http.post('login', { email: this.email, password: this.password }).then(res => this.handleLoginResult(res))
            },
            handleLoginResult (res) {
                this.reset()
                this.$store.commit('SET_TOKEN', { token: res.data.token })
                this.$store.commit('SET_USER', { user: res.data.user })
                this.$router.push({ name:  'dashboard.index' })
            },
            reset () {
                // this.email = ''
                // this.password = ''
            },
        },
    }
</script>

<template>
    <div>
        <form class="well login" @submit.prevent="submit">
            <div class="form-group">
                <label class="control-label">E-mail</label>
                <input v-model="email" type="email" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label">Senha</label>
                <input v-model="password" type="password" class="form-control">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
</template>

<style scoped>
    .login {
        width: 400px;
        margin: 30px auto;
    }
</style>