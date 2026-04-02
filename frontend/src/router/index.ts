import CreateView from '@/views/CreateView.vue'
import DeleteView from '@/views/DeleteView.vue'
import EditView from '@/views/EditView.vue'
import ReadView from '@/views/ReadView.vue'
import UpdateView from '@/views/UpdateView.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/', name: 'create', component: CreateView},
    {path: '/read', name: 'read', component: ReadView},
    {path: '/update', name: 'update', component: UpdateView},
    {path: '/:id/edit', name: 'edit', component: EditView},
    {path: '/delete', name: 'delete', component: DeleteView},

  ],
})

export default router
