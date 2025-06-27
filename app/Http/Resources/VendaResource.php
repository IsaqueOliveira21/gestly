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
            'user' => (integer) $this->user_id,
            'cliente' => (integer) $this->cliente_id,
            'total' => (float) $this->total,
            'data_venda' => (string) $this->data_venda,
        ];
    }
}
