<?php

namespace App\Services;

use App\Models\Venda;
use Illuminate\Support\Collection;

class VendaService
{
    public function listarTodas(): Collection
    {
        return Venda::with('vendedor')->get();
    }

    public function listarPorVendedor(int $vendedorId): Collection
    {
        return Venda::with('vendedor')->where('vendedor_id', $vendedorId)->get();
    }

    public function cadastrar(array $dados): Venda
    {
        return Venda::create($dados);
    }

    public function calcularComissao(Venda $venda): float
    {
        return $venda->valor * 0.085;
    }
}
