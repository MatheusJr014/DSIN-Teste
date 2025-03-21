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
        try {
            // Validação
            $validated = $request->validate([
                'appointmentsstatus' => 'required|string',
                'appointmentsorder' => 'required|integer',
                'appointmentsuserid' => 'required|exists:users,id',
                'appointmentsserviceid' => 'required|exists:services,id',
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
    
            return response()->json(['message' => 'Agendamento criado com sucesso'], 200);
    
        } catch (\Exception $e) {
            // Log do erro
    
            return response()->json(['error' => 'Erro ao salvar o agendamento'], 500);
        }
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
        $appointment = Appointments::find($id); 
        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        return response()->json($appointment);

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
        $appointment = Appointments::findOrFail($id);

    
        // Verifica se o professor logado está tentando atualizar seu próprio perfil
        // if ($professor->id != $id) {
        //     return response()->json(['error' => 'Acesso negado.'], 403);
        // }
    
        $data = $request->validate([
            'appointmentsstatus' => 'required|string',
            'appointmentsorder' => 'required|integer',
            'appointmentsuserid' => 'required|exists:users,id', // Validando se o usuário existe
            'appointmentsserviceid' => 'required|exists:services,id', // Validando se o serviço existe
            'appointmentsterm' => 'required|boolean',
            'appointmentsdate' => 'required|date',
        ]);
    
        $appointment->update($data);
        return response()->json($appointment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->delete();
        return response()->noContent();
    }
}
