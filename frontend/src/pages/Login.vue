<template>
    <div class="login-page">
        <LoginForm />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import LoginForm from '@/components/LoginForm.vue'

export default defineComponent({
    name: 'Login',
    components: {
        LoginForm
    }
})
</script>
