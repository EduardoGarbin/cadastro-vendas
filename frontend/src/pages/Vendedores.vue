<template>
    <div class="vendedores-page">
        <h1>Vendedores</h1>
        <VendedorForm @vendedorCadastrado="atualizarLista" />
        <ListaVendedores ref="lista" />
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import VendedorForm from '@/components/VendedorForm.vue'
import ListaVendedores from '@/components/ListaVendedores.vue'

export default defineComponent({
    name: 'Vendedores',
    components: {
        VendedorForm,
        ListaVendedores
    },
    setup() {
        const lista = ref<InstanceType<typeof ListaVendedores> | null>(null)

        const atualizarLista = () => {
            lista.value?.carregar()
        }

        return { lista, atualizarLista }
    }
})
</script>

<style scoped>
.vendedores-page {
    max-width: 900px;
    margin: 2rem auto;
    padding: 1rem;
}
</style>
