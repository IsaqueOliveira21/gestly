<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => (integer) $this->user_id,
            'nome' => (string) $this->nome,
            'preco' => (float) $this->preco,
            'descricao' => (string) $this->descricao,
        ];
    }
}
