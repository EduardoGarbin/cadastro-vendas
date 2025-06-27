export interface Usuario {
    id: number
    name: string
    email: string
    email_verified_at: string | null
    created_at: string
    updated_at: string
}

export interface LoginResponse {
    status: string
    mensagem: string
    data: {
        usuario: Usuario
        token: string
    }
}
