<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';

    protected $fillable = [
        'user_id',
        'cliente_id',
        'total',
        'data_venda',
    ];

    protected $casts = [
        'total' => 'float',
        'data_venda' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function itensVendas() {
        return  $this->hasMany(ItemVenda::class);
    }
}
