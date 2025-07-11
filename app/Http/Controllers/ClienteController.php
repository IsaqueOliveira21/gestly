<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResource;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Throwable;

class ClienteController extends Controller
{
    private $service;

    public function __construct(ClienteService $clienteService) {
        $this->service = $clienteService;
    }
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        try {
            $filters = $request->validate([
                'nome' => 'string|nullable',
                'telefone' => 'string|nullable',
                'email' => 'string|nullable',
            ]);
            $clientes = $this->service->index($filters);
            return ClienteResource::collection($clientes);
        } catch(Throwable $e) {
            return response()->json(['error' => 'Ocorreu um erro ao listar clientes'], 500);
        }
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nome' => 'string|required',
                'sobrenome' => 'string|nullable',
                'telefone' => 'string|nullable',
                'email' => 'string|nullable',
            ]);
            
            $novoCliente = $this->service->store($data);
            return new ClienteResource($novoCliente);
        } catch(Throwable $e) {
            return response()->json(['error' => 'Erro ao cadastrar cliente.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cliente = $this->service->show($id);
            return new ClienteResource($cliente);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'nome' => 'string|nullable',
                'sobrenome' => 'string|nullable',
                'telefone' => 'string|nullable',
                'email' => 'string|nullable',
            ]);
            $clienteUpdated = $this->service->update($data, $id);
            return new ClienteResource($clienteUpdated);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return $this->service->destroy($id);           
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
