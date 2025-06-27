import axios from 'axios'
import type { Vendedor } from '@/types/Vendedor'

export const listarVendedores = async (): Promise<Vendedor[]> => {
    const token = localStorage.getItem('token')
    const response = await axios.get('http://localhost:8080/api/vendedores', {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
    return response.data.data
}

export const criarVendedor = async (dados: { nome: string; email: string }) => {
    const token = localStorage.getItem('token')
    return axios.post('http://localhost:8080/api/vendedores', dados, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
}
