<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemVendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'venda_id' => (integer) $this->venda_id,
            'produto_id' => (integer) $this->produto_id,
            'valor' => (float) $this->valor,
            'quantidade' => (integer) $this->quantidade
        ];
    }
}
