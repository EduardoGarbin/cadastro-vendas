<?php

namespace App\Console\Commands;

use App\Mail\ResumoVendasAdminMail;
use App\Mail\ResumoVendasVendedorMail;
use App\Models\Venda;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarResumoVendasDiario extends Command
{
    protected $signature = 'vendas:enviar-resumo-diario';
    protected $description = 'Comando para enviar o resumo diário de vendas';

    public function handle()
    {
        $hoje = now()->toDateString();

        $vendas = Venda::with('vendedor')->whereDate('data', $hoje)->get();

        $resumoPorVendedor = $vendas->groupBy('vendedor_id')->map(function ($vendasDoVendedor) {
            $total = $vendasDoVendedor->sum('valor');
            $comissao = $vendasDoVendedor->sum(fn($venda) => $venda->valor * 0.085);

            return [
                'quantidade' => $vendasDoVendedor->count(),
                'valor_total' => $total,
                'comissao_total' => $comissao,
                'vendedor' => $vendasDoVendedor->first()->vendedor,
            ];
        });

        foreach ($resumoPorVendedor as $dados) {
            Mail::to($dados['vendedor']->email)->send(new ResumoVendasVendedorMail($dados));
        }

        $valorTotal = $vendas->sum('valor');

        Mail::to(config('app.default_user_email'))->send(
            new ResumoVendasAdminMail($valorTotal)
        );
    }
}
