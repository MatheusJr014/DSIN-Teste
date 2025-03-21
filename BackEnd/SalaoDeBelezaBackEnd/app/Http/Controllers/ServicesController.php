<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ServicesController extends Controller
{
    protected $model; 
    public function __construct(Services $services)
    {
        $this->model = $services; 
    }
    public function index()
    {
        return response($this->model->all());
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //Validação
        $request->validate([
            'servicetype' => 'required|string',
            'serviceprice' => 'required|numeric', 
            'serviceimage' => 'nullable|string',
            'servicedescription' => 'required|string',
        ]);
    
        //Criação do serviço 
        Services::create([
            'servicetype' => $request->servicetype,
            'serviceprice' => $request->serviceprice, 
            'serviceimage' => $request->serviceimage,
            'servicedescription' => $request->servicedescription,
        ]);
        //Retorna a respossta 
        return response()->json(['message' => 'Serviço criado com sucesso'], 201);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Services::find($id);
        if(!$service){
            return response()->json(['error' => 'Service not found'], 404);

        }

        return response()->json($service);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Services::findOrFail($id);

    
        // Verifica se o professor logado está tentando atualizar seu próprio perfil
        // if ($professor->id != $id) {
        //     return response()->json(['error' => 'Acesso negado.'], 403);
        // }
    
        $data = $request->validate([
            'servicetype' => 'required|string|max:255',
            'serviceprice' => 'required|numeric',
            'serviceimage' => 'nullable|string',
            'servicedescription' => 'string'
        ]);

    
        $service->update($data);
        return response()->json($service, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $service = Services::findOrFail($id);
        $service->delete();

        return response()->noContent();
    }
}
