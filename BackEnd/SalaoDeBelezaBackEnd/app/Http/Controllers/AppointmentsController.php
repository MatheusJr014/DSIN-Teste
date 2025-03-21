<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{

    protected $model;
    public function __construct(Appointments $appointments)
    {
        $this->model = $appointments;
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
        // Validação
        $validated = $request->validate([
            'appointmentsstatus' => 'required|string',
            'appointmentsorder' => 'required|integer',
            'appointmentsuserid' => 'required|exists:users,id', // Validando se o usuário existe
            'appointmentsserviceid' => 'required|exists:services,id', // Validando se o serviço existe
            'appointmentsterm' => 'required|boolean',
            'appointmentsdate' => 'required|date',
        ]);

        // Criação do agendamento
        Appointments::create([
            'appointmentsstatus' => $validated['appointmentsstatus'],
            'appointmentsorder' => $validated['appointmentsorder'],
            'appointmentsuserid' => $validated['appointmentsuserid'],
            'appointmentsserviceid' => $validated['appointmentsserviceid'],
            'appointmentsterm' => $validated['appointmentsterm'],
            'appointmentsdate' => $validated['appointmentsdate'],
        ]);

        // Retornar resposta com sucesso
        return response()->json([
            'message' => 'Agendamento criado com sucesso'
        ], 201);
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
