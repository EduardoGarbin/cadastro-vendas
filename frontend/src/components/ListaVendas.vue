<template>
    <div class="vendas-wrapper">
        <h1>Vendas</h1>

        <div class="vendas-actions">
            <router-link to="/vendas/nova" class="nova-venda-btn">+ Nova Venda</router-link>
            <router-link to="/vendedores" class="ver-vendedores-btn">Vendedores</router-link>
        </div>

        <table class="vendas-tabela" v-if="vendas.length">
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="venda in vendas" :key="venda.id">
                    <td>{{ venda.vendedor.nome }}</td>
                    <td>R$ {{ venda.valor }}</td>
                    <td>{{ venda.data }}</td>
                </tr>
            </tbody>
        </table>

        <p v-else>Nenhuma venda encontrada.</p>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import { listarVendas } from '@/services/vendaService'
import type { Venda } from '@/types/Venda'

export default defineComponent({
    name: 'ListaVendas',
    setup() {
        const vendas = ref<Venda[]>([])

        const carregar = async () => {
            vendas.value = await listarVendas()
        }

        const formatarData = (data: string) => {
            return new Date(data).toLocaleDateString('pt-BR')
        }

        onMounted(carregar)

        return { vendas, formatarData }
    }
})
</script>

<style scoped>
.vendas-wrapper {
    max-width: 900px;
    margin: 2rem auto;
    padding: 1rem;
}

.vendas-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-bottom: 1rem;
}

.nova-venda-btn,
.ver-vendedores-btn {
    background: var(--primary);
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: var(--radius);
    font-weight: bold;
    transition: 0.2s ease-in-out;
}

.nova-venda-btn:hover,
.ver-vendedores-btn:hover {
    background: #4338ca;
}

.vendas-tabela {
    width: 100%;
    border-collapse: collapse;
}

.vendas-tabela th,
.vendas-tabela td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}
</style>
