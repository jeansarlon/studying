
<script>

    export default {
        data () {
            return {
                successMessage: '',
            }
        },
        computed: {
            hasSuccessMessage () {
                return this.successMessage !== ''
            }
        },
        mounted () {
            this.$bus.$on('set-success-msg', obj => this.successMessage = obj.msg)
        },
    }
</script>

<template>
    <div>
        <div class="alert alert-success" v-show="hasSuccessMessage">
            {{ successMessage }}
        </div>
    </div>
</template>