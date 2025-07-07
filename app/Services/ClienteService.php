<?php

namespace App\Services;

use App\Models\Cliente;
use Exception;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class ClienteService {

    private $cliente;

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    public function index(Array $filters) {
        try {
            $clientes = auth()->user()->clientes()
                // Verificar filtros para pesquisar tudo de uma vez, nome, email ou telefone
                ->when(isset($filters['nome']), function($query) use ($filters) {
                    return $query->where('nome', 'LIKE', "%{$filters['nome']}%");
                })
                ->paginate(20);
            return $clientes;
        } catch(Exception $e) {
            Log::error("Cliente index error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException("Error ao listar clientes.");
        }
    }

    public function store(Array $data) {
        try {
            $novoCliente = auth()->user()->clientes()->create($data);
            return $novoCliente;
        } catch(Exception $e) {
            Log::error("Cliente create error: Line: ".$e->getLine()." | Message: ".$e->getMessage());
            throw new RuntimeException("Error ao cadastrar cliente.");
        }
    }

    public function show(Int $id) {
        try {
            $cliente = auth()->user()->clientes()->find($id);
            if(!$cliente) {
                throw new RuntimeException("Cliente não encontrado.");
            }
            return $cliente;
        } catch(Exception $e) {
            Log::error("Cliente show error: Line: ".$e->getMessage()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }

    public function update(Array $data, Int $id) {
        try {
            $cliente = auth()->user()->clientes()->find($id);
            if(!$cliente) {
                throw new RuntimeException("Cliente não encontrado.");
            }
            $cliente->update($data);
            return $cliente;
        } catch(Exception $e) {
            Log::error("Cliente show error: Line: ".$e->getMessage()." | Message: ".$e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }
}

?>