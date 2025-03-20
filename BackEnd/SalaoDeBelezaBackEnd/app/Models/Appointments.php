<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Appointments extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = "appointments";  
    
    protected $fillable = [
        'appointmentstype', #Tipo do agendamento
        'appointmentsstatus', #Status do agendamento
        'appointmentsorder', ##Ordem do agendamento
        'appointmentsclientid', ##Cliente Id
        'appointmentsservice', ##Serviço
        'appointmentsterm', ##Prazo booleano 
        'appointmentsdate' #Data do agendamento
    ];
}
