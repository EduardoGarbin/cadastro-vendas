<?php

namespace App\Services;

use App\Models\Vendedor;

class VendedorService
{
    public function listarTodos()
    {
        return Vendedor::all();
    }

    public function cadastrar(array $dados)
    {
        return Vendedor::create($dados);
    }
}
