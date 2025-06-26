<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vendedor' => [
                'id' => $this->vendedor->id,
                'nome' => $this->vendedor->nome,
                'email' => $this->vendedor->email,
            ],
            'valor' => number_format($this->valor, 2, ',', '.'),
            'data' => $this->data,
            'comissao' => number_format($this->comissao, 2, ',', '.'),
        ];
    }
}
