<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService {

    private $cliente;

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }
}

?>