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
        $data = $request->validate([
            'appointmentstype' => 'required|string',
            'appointmentsstatus' => 'required|boolean',
            'appointmentsorder' => 'required|integer',
            'appointmentsclientid' => 'required|string',
            'appointmentsservice' => 'required|string',
            'appointmentsterm' => 'required|boolean',
            'appointmentdate' => 'required|date',
        ]);

        // Criação do agendamento
        Appointments::create([
            'appointmentstype' => $data['appointmentstype'],
            'appointmentsstatus' => $data['appointmentsstatus'],
            'appointmentsorder' => $data['appointmentsorder'],
            'appointmentsclientid' => $data['appointmentsclientid'],
            'appointmentsservice' => $data['appointmentsservice'],
            'appointmentsterm' => $data['appointmentsterm'],
            'appointmentdate' => $data['appointmentdate']
        ]);

        // Retorno de sucesso
        return response()->json(['message' => 'Agendamento Realizado com sucesso!'], 201);
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
