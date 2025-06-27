<template>
  <div class="login-container">
    <form class="login-card" @submit.prevent="handleLogin">
      <h2>Entrar no sistema</h2>

      <label for="email">Email</label>
      <input id="email" v-model="email" type="email" required />

      <label for="password">Senha</label>
      <input id="password" v-model="password" type="password" required />

      <button type="submit">Entrar</button>

      <p v-if="errorMessage" class="error-message">
        * {{ errorMessage }}
      </p>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import { login } from '@/services/authService'
import { useRouter } from 'vue-router'
import type { LoginResponse } from '@/types/Auth'

export default defineComponent({
  name: 'LoginForm',
  setup() {
    const email = ref<string>('')
    const password = ref<string>('')
    const errorMessage = ref<string | null>(null)

    const router = useRouter()

    const handleLogin = async () => {
      try {
        errorMessage.value = null

        const response: LoginResponse = await login(email.value, password.value)
        const { token, usuario } = response.data

        localStorage.setItem('token', token)
        localStorage.setItem('usuario', JSON.stringify(usuario))

        router.push('/vendas')
      } catch (error: any) {
        errorMessage.value = error.response?.data?.mensagem || 'Erro ao realizar login.'
      }
    }

    return { email, password, handleLogin, errorMessage }
  }
})
</script>

<style scoped>
.login-container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-card {
  background-color: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  padding: 2rem;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

h2 {
  margin-bottom: 0.5rem;
  text-align: center;
}

label {
  font-weight: 500;
}

input {
  width: 100%;
}

button {
  width: 100%;
  margin-top: 1rem;
}

.error-message {
  color: #e11d48;
  font-size: 0.875rem;
  margin-top: 0.5rem;
  font-weight: 500;
}
</style>
