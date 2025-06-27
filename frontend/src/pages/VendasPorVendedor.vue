<template>
    <div class="vendas-vendedor-page">
        <button @click="voltar" class="voltar-btn">← Voltar</button>

        <h2>Vendas de {{ vendedor?.nome }}</h2>

        <table class="vendas-tabela" v-if="vendas.length">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Comissão</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="venda in vendas" :key="venda.id">
                    <td>{{ venda.data }}</td>
                    <td>R$ {{ venda.valor }}</td>
                    <td>R$ {{ venda.comissao }}</td>
                </tr>
            </tbody>
        </table>

        <p v-else>Nenhuma venda encontrada para este vendedor.</p>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { listarVendasPorVendedor } from '@/services/vendaService'
import type { Venda } from '@/types/Venda'

export default defineComponent({
    name: 'VendasPorVendedor',
    setup() {
        const route = useRoute()
        const router = useRouter()
        const vendas = ref<Venda[]>([])
        const vendedor = ref<Venda['vendedor'] | null>(null)

        const carregar = async () => {
            const id = Number(route.params.id)
            const resultado = await listarVendasPorVendedor(id)
            vendas.value = resultado
            vendedor.value = resultado[0]?.vendedor || null
        }

        const voltar = () => router.back()

        onMounted(carregar)

        return { vendas, vendedor, voltar }
    }
})
</script>

<style scoped>
.vendas-vendedor-page {
    max-width: 900px;
    margin: 2rem auto;
    padding: 1rem;
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

.voltar-btn {
    margin-bottom: 1rem;
    background: transparent;
    border: none;
    color: var(--primary);
    font-weight: bold;
    cursor: pointer;
}
</style>
