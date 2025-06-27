import axios from 'axios'
import type { Venda } from '@/types/Venda'

export const listarVendas = async (): Promise<Venda[]> => {
    const token = localStorage.getItem('token')
    const response = await axios.get('http://localhost:8080/api/vendas', {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
    return response.data.data
}

export const criarVenda = async (dados: {
    vendedor_id: number
    valor: number
    data: string
}) => {
    const token = localStorage.getItem('token')
    return axios.post('http://localhost:8080/api/vendas', dados, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
}

export const listarVendasPorVendedor = async (vendedorId: number): Promise<Venda[]> => {
    const token = localStorage.getItem('token')
    const response = await axios.get(`http://localhost:8080/api/vendedores/${vendedorId}`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
    return response.data.data
}

export const reenviarComissaoPorVendedor = async (id: number): Promise<void> => {
    const token = localStorage.getItem('token');
    const response = await axios.post(
        `http://localhost:8080/api/vendedores/${id}/reenviar-email`,
        {},
        {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }
    );
    return response.data;
};

