<template>
    <form @submit.prevent="handleSubmit" class="vendedor-form">
        <label>Nome</label>
        <input v-model="nome" required />

        <label>Email</label>
        <input v-model="email" type="email" required />

        <button type="submit">Cadastrar Vendedor</button>

        <p v-if="mensagem" class="form-mensagem">{{ mensagem }}</p>
    </form>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { criarVendedor } from '@/services/vendedorService'

export default defineComponent({
    name: 'VendedorForm',
    emits: ['vendedorCadastrado'],
    setup(_, { emit }) {
        const nome = ref('')
        const email = ref('')
        const mensagem = ref('')

        const handleSubmit = async () => {
            try {
                await criarVendedor({ nome: nome.value, email: email.value })
                mensagem.value = 'Vendedor cadastrado com sucesso!'
                nome.value = ''
                email.value = ''
                emit('vendedorCadastrado')
            } catch (error: any) {
                mensagem.value = error.response?.data?.mensagem || 'Erro ao cadastrar vendedor.'
            }
        }

        return { nome, email, handleSubmit, mensagem }
    }
})
</script>

<style scoped>
.vendedor-form {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    max-width: 400px;
}

button {
    margin-top: 1rem;
}

.form-mensagem {
    color: green;
    font-weight: bold;
}
</style>
