<template>
    <ListaVendas />
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import ListaVendas from '@/components/ListaVendas.vue'

export default defineComponent({
    name: 'Vendas',
    components: {
        ListaVendas
    }
})
</script>
