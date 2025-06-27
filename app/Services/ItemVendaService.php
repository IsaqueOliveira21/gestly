<?php

namespace App\Services;

use App\Models\ItemVenda;

class ItemVendaService {

    private $itemVenda;

    public function __construct(ItemVenda $itemVenda) {
        $this->itemVenda = $itemVenda;
    }
}

?>