import axios from 'axios'
import type { LoginResponse } from '@/types/Auth'

export const login = async (email: string, password: string): Promise<LoginResponse> => {
    const response = await axios.post<LoginResponse>('http://localhost:8080/api/login', {
        email,
        password
    })

    return response.data
}
