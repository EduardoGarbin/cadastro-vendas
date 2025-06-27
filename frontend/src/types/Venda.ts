import type { Vendedor } from './Vendedor'

export interface Venda {
    id: number
    valor: string
    data: string
    comissao: string
    vendedor: Vendedor
}
