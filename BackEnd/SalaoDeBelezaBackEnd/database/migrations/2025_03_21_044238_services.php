<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('services',function(Blueprint $table){
            $table->id();
            $table->string('servicetype');
            $table->float('serviceprice');
            $table->string('serviceimage');
            $table->string('servicedescription');
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointmentsstatus'); // Status do agendamento
            $table->integer('appointmentsorder'); // Ordem do agendamento
            $table->foreignId('appointmentsuserid') // Cliente ID como chave estrangeira
                  ->constrained('users') // Referencia a tabela users(id)
                  ->onDelete('cascade'); // Se um usuário for deletado, os agendamentos dele também são apagados
            $table->foreignId('appointmentsserviceid') // Serviço
                  ->constrained('services')
                  ->onDelete('cascade'); 
            $table->boolean('appointmentsterm'); // Prazo booleano
            $table->date('appointmentsdate'); // Data do agendamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('services');
    }
};
