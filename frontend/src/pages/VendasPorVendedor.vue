<template>
    <div class="vendas-vendedor-page">
        <button @click="voltar" class="voltar-btn">← Voltar</button>

        <div class="acoes" v-if="vendas.length">
            <h2>Vendas de {{ vendedor?.nome }}</h2>
            <button @click="reenviarEmail" class="reenviar-btn">Reenviar e-mail de comissão</button>
        </div>
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
import { listarVendasPorVendedor, reenviarComissaoPorVendedor } from '@/services/vendaService'
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

        const reenviarEmail = async () => {
            try {
                if (!vendedor.value?.id) return
                await reenviarComissaoPorVendedor(vendedor.value.id)
                alert('E-mail reenviado com sucesso!')
            } catch (error: any) {
                alert(`${error.response?.data?.mensagem || 'Erro ao reenviar e-mail.'}`)
            }
        }

        const voltar = () => router.back()

        onMounted(carregar)

        return { vendas, vendedor, reenviarEmail, voltar }
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

.acoes {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.reenviar-btn {
    background-color: #2563eb;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.reenviar-btn:hover {
    background-color: #1d4ed8;
}
</style>
