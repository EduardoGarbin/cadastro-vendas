<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendedor\StoreVendedorRequest;
use App\Resources\VendedorResource;
use App\Services\VendedorService;

class VendedorController extends Controller
{
    public function __construct(private VendedorService $vendedorService) {}

    public function index()
    {
        $vendedores = $this->vendedorService->listarTodos();

        return response()->json([
            'status' => 'success',
            'mensagem' => $vendedores->isEmpty()
                ? 'Nenhum vendedor encontrado.'
                : 'Lista de vendedores retornada com sucesso.',
            'data' => VendedorResource::collection($vendedores),
        ]);
    }

    public function store(StoreVendedorRequest $request)
    {
        $vendedor = $this->vendedorService->cadastrar($request->validated());

        return response()->json([
            'status' => 'success',
            'mensagem' => 'Vendedor cadastrado com sucesso.',
            'data' => new VendedorResource($vendedor),
        ], 201);
    }
}
