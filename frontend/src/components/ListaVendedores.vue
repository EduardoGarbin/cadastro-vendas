<template>
    <div class="vendedor-lista">
        <button class="voltar-btn" @click="voltar">← Voltar</button>

        <h2>Vendedores cadastrados</h2>

        <div class="vendedor-grid" v-if="vendedores.length">
            <router-link v-for="v in vendedores" :key="v.id" :to="`/vendas/vendedor/${v.id}`" class="vendedor-card">
                <p class="nome">{{ v.nome }}</p>
                <p class="email">{{ v.email }}</p>
            </router-link>
        </div>

        <p v-else>Nenhum vendedor cadastrado.</p>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import { listarVendedores } from '@/services/vendedorService'
import { useRouter } from 'vue-router'
import type { Vendedor } from '@/types/Vendedor'

export default defineComponent({
    name: 'ListaVendedores',

    setup() {
        const router = useRouter()

        const voltar = () => {
            router.go(-1)
        }

        const vendedores = ref<Vendedor[]>([])

        const carregar = async () => {
            vendedores.value = await listarVendedores()
        }

        onMounted(carregar)

        return { vendedores, carregar, voltar }
    }

})
</script>

<style scoped>
.vendedor-lista {
    margin-top: 2rem;
}

.vendedor-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1rem;
}

.vendedor-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    transition: 0.2s ease-in-out;
    text-decoration: none;
    color: inherit;
}

.vendedor-card {
    text-decoration: none;
    color: inherit;
}

.nome {
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.email {
    color: #4b5563;
    font-size: 0.9rem;
}
</style>
