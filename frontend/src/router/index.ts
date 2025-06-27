import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/pages/Login.vue'
import Vendas from '@/pages/Vendas.vue'
import VendasPorVendedor from '@/pages/VendasPorVendedor.vue'
import VendaNova from '@/pages/VendaNova.vue'
import Vendedores from '@/pages/Vendedores.vue'

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login
    },
    {
        path: '/vendas',
        name: 'vendas',
        component: Vendas
    },
    {
        path: '/vendas/nova',
        name: 'venda-nova',
        component: VendaNova
    },
    {
        path: '/vendedores',
        name: 'vendedores',
        component: Vendedores
    },
    {
        path: '/vendas/vendedor/:id',
        name: 'vendas-por-vendedor',
        component: VendasPorVendedor
    },
    {
        path: '/login',
        redirect: '/'
    }
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})
