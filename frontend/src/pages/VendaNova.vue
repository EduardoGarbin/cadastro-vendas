<template>
    <VendaForm />
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import VendaForm from '@/components/VendaForm.vue'

export default defineComponent({
    name: 'VendaNova',
    components: {
        VendaForm
    }
})
</script>
