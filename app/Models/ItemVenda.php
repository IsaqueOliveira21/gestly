<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $table = 'itens_vendas';

    protected $fillable = [
        'venda_id',
        'produto_id',
        'valor',
        'quantidade'
    ];

    protected $casts = [
        'valor' => 'float',
        'quantidade' => 'integer',
    ];

    public function venda() {
        return $this->belongsTo(Venda::class);
    }

    public function produto() {
        return $this->belongsTo(Produto::class);
    }
}
