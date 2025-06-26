<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendedorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'criado_em' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
