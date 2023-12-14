<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ContratoType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('holders', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edad');
            $table->string('dni');
            $table->string('empleo');
            $table->integer('tipo_contrato')->default(ContratoType::INDEFINIDO);
            $table->integer('antiguedad');
            $table->float('salario',10,2);
            $table->integer('pagos');
            $table->float('renta',10,2);
            $table->foreignId('expedient_id')->nullable()->constrained('expedients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('holders', function (Blueprint $table) {
            $table->dropForeign(['expedient_id']);
        });
        Schema::dropIfExists('holders');
    }
};
