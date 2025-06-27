<?php

namespace App\Http\Controllers;

use App\Http\Requests\Venda\StoreVendaRequest;
use App\Http\Resources\VendaResource;
use App\Services\VendaService;

class VendaController extends Controller
{
    public function __construct(private VendaService $vendaService) {}

    public function index()
    {
        $vendas = $this->vendaService->listarTodas();

        foreach ($vendas as $venda) {
            $venda->comissao = $this->vendaService->calcularComissao($venda);
        }

        return response()->json([
            'status' => 'success',
            'mensagem' => $vendas->isEmpty()
                ? 'Nenhuma venda encontrada.'
                : 'Lista de vendas retornada com sucesso.',
            'data' => VendaResource::collection($vendas),
        ]);
    }

    public function store(StoreVendaRequest $request)
    {
        $venda = $this->vendaService->cadastrar($request->validated());
        $venda->comissao = $this->vendaService->calcularComissao($venda);

        return response()->json([
            'status' => 'success',
            'mensagem' => 'Venda cadastrada com sucesso.',
            'data' => new VendaResource($venda),
        ], 201);
    }

    public function porVendedor($id)
    {
        $vendas = $this->vendaService->listarPorVendedor($id);

        foreach ($vendas as $venda) {
            $venda->comissao = $this->vendaService->calcularComissao($venda);
        }

        return response()->json([
            'status' => 'success',
            'mensagem' => $vendas->isEmpty()
                ? 'Nenhuma venda encontrada para este vendedor.'
                : 'Vendas do vendedor retornadas com sucesso.',
            'data' => VendaResource::collection($vendas),
        ]);
    }

    public function reenviarEmailComissao($id)
    {
        try {
            $this->vendaService->reenviarEmailResumoVendedor($id);

            return response()->json([
                'status' => 'success',
                'mensagem' => 'Resumo de comissão reenviado com sucesso.'
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'status' => 'error',
                'mensagem' => $e->getMessage()
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'mensagem' => 'Erro inesperado ao reenviar o e-mail.'
            ], 500);
        }
    }
}
