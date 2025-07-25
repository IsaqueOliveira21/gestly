<?php

namespace App\Services;

use App\Models\Venda;
use Exception;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class VendaService {

    private $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function index() {
        try {
            $vendas = $this->venda->where('user_id', auth()->user()->id)->paginate(30);
            return $vendas;
        } catch(Exception $e) {
            Log::error("Venda index error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    public function show(Int $id) {
        try {
            $venda = $this->venda->find($id);
            if(!$venda || $venda->user_id !== auth()->user()->id) {
                throw new RuntimeException("Venda não encontrada.");
            }
            return $venda;
        } catch(Exception $e) {
            Log::error("Venda show error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    public function store(Array $data) {
        try {
            $data['user_id'] = auth()->user()->id;
            $novaVenda = $this->venda->create($data);
            return $novaVenda;
        } catch(Exception $e) {
            Log::error("Venda store error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    public function update(Venda $venda, Array $data) {
        try {
            if($venda->user_id !== auth()->user()->id) {
                throw new RuntimeException("Venda não encontrada...");
            }
            $venda->update($data);
            return $venda;
        } catch(Exception $e) {
            Log::error("Venda update error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    public function destroy(Venda $venda) {
        try {
            if($venda->user_id !== auth()->user()->id) {
                throw new RuntimeException("Venda não encontrada...");
            }
            $venda->delete();
        } catch(Exception $e) {
            Log::error("Venda delete error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }
}

?>
