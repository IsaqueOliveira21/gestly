<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService {

    private $produto;

    public function __construct(Produto $produto) {
        $this->produto = $produto;
    }
}

?>