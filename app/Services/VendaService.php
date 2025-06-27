<?php

namespace App\Services;

use App\Models\Venda;

class VendaService {

    private $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }
}

?>