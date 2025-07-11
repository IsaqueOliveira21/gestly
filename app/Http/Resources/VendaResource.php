<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (Integer) $this->id,
            'user_id' => (Integer) $this->user_id,
            'cliente_id' => (Integer) $this->cliente_id,
            'total' => (Float) $this->total,
            'data_venda' => (String) $this->data_venda,
        ];
    }
}
