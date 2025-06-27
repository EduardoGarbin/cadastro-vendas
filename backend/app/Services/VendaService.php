<?php

namespace App\Services;

use App\Mail\ResumoVendasAdminMail;
use App\Models\Venda;
use App\Models\Vendedor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

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

    public function reenviarEmailResumoVendedor($vendedorId)
    {
        $hoje = now()->toDateString();

        $vendedor = Vendedor::find($vendedorId);

        if (!$vendedor) {
            throw new \RuntimeException('Vendedor não encontrado.');
        }

        $vendas = Venda::with('vendedor')->whereDate('data', $hoje)->get();

        $valorTotal = $vendas->sum('valor');

        Mail::to(config('app.admin_email', $vendedor->email))->send(
            new ResumoVendasAdminMail($valorTotal)
        );
    }
}
