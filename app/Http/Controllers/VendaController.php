<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendaResource;
use App\Models\Venda;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Throwable;

class VendaController extends Controller
{

    private $service;

    public function __construct(VendaService $vendaService) {
        $this->service = $vendaService;
    }

    public function index() {
        try {
            $vendas = $this->service->index();
            return VendaResource::collection($vendas);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Int $id) {
        try {
            $venda = $this->service->show($id);
            return new VendaResource($venda);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request) {
        try {
            $data = $request->validate([
                'cliente_id' => 'nullable|numeric',
                'total' => 'required|numeric',
                'data_venda' => 'required|date'
            ]);

            $novaVenda = $this->service->store($data);
            return new VendaResource($novaVenda);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Venda $venda, Request $request) {
        try {
            $data = $request->validate([
                'cliente_id' => 'nullable|numeric',
                'total' => 'nullable|numeric',
                'data_venda' => 'nullable|date'
            ]);
            $updatedVenda = $this->service->update($venda, $data);
            return new VendaResource($updatedVenda);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Venda $venda) {
        try {
            $this->service->destroy($venda);
            return response()->json(['success' => "Venda excluida com sucesso!"], 200);
        } catch(Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
