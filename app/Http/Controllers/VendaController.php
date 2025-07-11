<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendaResource;
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
}
