<template>
    <form @submit.prevent="handleSubmit" class="venda-form">
        <label for="vendedor">Vendedor</label>
        <select v-model="vendedorId" required>
            <option value="">Selecione</option>
            <option v-for="v in vendedores" :key="v.id" :value="v.id">
                {{ v.nome }}
            </option>
        </select>

        <label for="valor">Valor</label>
        <input v-model.number="valor" type="number" required min="0" step="0.01" />

        <label for="data">Data</label>
        <input v-model="data" type="date" required />

        <button type="submit">Cadastrar Venda</button>
        <button @click="voltar">← Voltar</button>

        <ul v-if="mensagens.length" class="form-erros">
            <li v-for="(msg, index) in mensagens" :key="index">{{ msg }}</li>
        </ul>
    </form>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import { listarVendedores } from '@/services/vendedorService'
import { criarVenda } from '@/services/vendaService'
import type { Vendedor } from '@/types/Vendedor'
import { useRouter } from 'vue-router'

export default defineComponent({
    name: 'VendaForm',
    setup() {
        const vendedores = ref<Vendedor[]>([])
        const vendedorId = ref<number | null>(null)
        const valor = ref<number>(0)
        const data = ref('')
        const router = useRouter()

        const voltar = () => {
            router.go(-1)
        }

        const carregarVendedores = async () => {
            vendedores.value = await listarVendedores()
        }

        const mensagens = ref<string[]>([])

        const handleSubmit = async () => {
            try {
                mensagens.value = []

                await criarVenda({
                    vendedor_id: vendedorId.value!,
                    valor: valor.value,
                    data: data.value
                })

                router.push('/vendas')
            } catch (error: any) {
                const erros = error.response?.data?.erros
                if (erros && typeof erros === 'object') {
                    mensagens.value = Object.values(erros.valor).flat().map(String)
                } else {
                    mensagens.value = [error.response?.data?.mensagem || 'Erro ao cadastrar venda.']
                }
            }
        }

        onMounted(carregarVendedores)

        return { vendedores, vendedorId, valor, data, handleSubmit, mensagens, voltar }
    }
})
</script>

<style scoped>
.venda-form {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    max-width: 400px;
    margin: 2rem auto;
}

button {
    margin-top: 1rem;
}

.form-mensagem {
    color: green;
    font-weight: bold;
}

.form-erros {
    margin-top: 1rem;
    color: #e11d48;
    list-style: disc;
    padding-left: 1.5rem;
}
</style>
