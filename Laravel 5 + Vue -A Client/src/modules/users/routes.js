
import VdUsers from './main.vue'
import VdForm from './form.vue'

export default [
    {
        name: 'users.index',
        path: '/usuarios',
        component: VdUsers,
        children: [
            {
                name: 'users.create',
                path: 'criar',
                component: VdForm,
            }, {
                name: 'users.edit',
                path: 'editar/:id',
                component: VdForm,
            }
        ]
    },
]