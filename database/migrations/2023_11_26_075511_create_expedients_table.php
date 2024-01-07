<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ViviendaType;
use App\Enums\ExpedientStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expedients', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('tipo')->default(ViviendaType::COMPRAVENTA);
            $table->integer('vivienda');
            $table->integer('estado')->default(ExpedientStatus::NO_CONTACTADO);
            $table->date('fecha_llamada');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('email');
            $table->float('importe_compra',10,2);
            $table->float('aportacion',10,2);
            $table->float('valor_aproximado',10,2);
            $table->float('importe_prestamo',10,2);
            $table->string('provincia');
            $table->string('localidad');
            $table->string('direccion');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expedients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('expedients');
    }
};
