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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
