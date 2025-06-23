<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        'user_id',
        'nome',
        'sobrenome',
        'telefone',
        'email',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vendas() {
        return $this->hasMany(Venda::class);
    }
}
