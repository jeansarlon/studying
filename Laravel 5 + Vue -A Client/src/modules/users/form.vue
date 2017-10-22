
<script>
    export default {
        props: ['token'],
        data () {
            return {
                isEditing: false,
                user: {
                    id: 0,
                    name: '',
                    email: '',
                    password: '',
                },
            }
        },
        methods: {
            getUser () {
                const userid = this.$route.params.id
                if (userid !== undefined) {
                    this.$http.get(`usuarios/${userid}`).then(res => {
                        this.user = res.data.user
                        this.isEditing = true
                    })
                }
            },
            submit () {
                this.$http.post(this.action, this.user).then(res => {
                    jQuery(this.$refs.modal).modal('hide')
                    this.reset()
                    this.$bus.$emit('set-success-msg', { msg: res.data.message })
                    // this.$bus.$emit('set-user', { user: res.data.user })
                    this.$store.commit('USERS_SET_USER', { user: res.data.user })
                })
            },
            reset () {
                this.user.name = ''
                this.user.email = ''
                this.user.password = ''
                this.user.id = 0
            },
        },
        computed: {
            action () {
                if (this.isEditing) {
                    return `usuarios/atualizar/${this.user.id}`
                } else {
                    return `usuarios/criar`
                }
            },
        },
        mounted () {
            this.getUser()

            const modal = jQuery(this.$refs.modal)
            modal.modal('show')
            modal.on('hidden.bs.modal', () => {
                this.reset()
                this.$router.push({ name: 'users.index' })
            })
        },
    }
</script>

<template>
    <div>
        <div ref="modal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Criar novo usuário</h4>
              </div>
              <div class="modal-body">
                <form method="post" @submit.prevent="submit">
                    <div class="form-group">
                        <label for="name" class="control-label">Nome</label>
                        <input id="name" name="name" type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <input id="email" name="email" type="email" class="form-control" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Senha</label>
                        <input id="password" name="password" type="password" class="form-control" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>