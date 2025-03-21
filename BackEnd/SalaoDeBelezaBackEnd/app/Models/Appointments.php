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
        'appointmentsstatus', #Status do agendamento
        'appointmentsorder', ##Ordem do agendamento
        'appointmentsuserid', ##Cliente Id
        'appointmentsserviceid', ##Serviço
        'appointmentsterm', ##Prazo booleano 
        'appointmentsdate' #Data do agendamento
    ];

    public function client()
    {
        return $this->belongsTo(Users::class, 'appointmentsuserid');
    }
    public function service(){
        return $this->belongsTo(Services::class, 'serviceid');
    }
}
