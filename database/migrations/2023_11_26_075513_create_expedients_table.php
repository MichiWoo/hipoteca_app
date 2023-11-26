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
            $table->string('tipo')->default(ViviendaType::Compraventa);
            $table->integer('vivienda');
            $table->string('estado')->default(ExpedientStatus::NoContactado);
            $table->date('fecha_llamada');
            $table->string('telefono1');
            $table->string('telefono2');
            $table->string('email');
            $table->float('importe_compra',10,2);
            $table->float('aportacion',10,2);
            $table->float('valor_aproximado',10,2);
            $table->float('importe_prestamo',10,2);
            $table->string('provincia');
            $table->string('localidad');
            $table->string('direccion');
            $table->foreignId('user_id')->nullable()->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('borrow_id')->nullable()->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
            $table->dropForeign(['borrow_id']);
        });
        Schema::dropIfExists('expedients');
    }
};
