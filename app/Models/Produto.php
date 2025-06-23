<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";

    protected $fillable = [
        'user_id',
        'nome',
        'preco',
        'descricao',
    ];

    protected $casts = [
        'preco' => 'float'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function itensVendas() {
        return $this->hasMany(ItemVenda::class);
    }
}
