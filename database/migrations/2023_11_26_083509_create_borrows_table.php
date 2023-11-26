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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->float('inicial',10,2);
            $table->float('pendiente',10,2);
            $table->float('cuota',10,2);
            $table->foreignId('bank_id')->nullable()->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('expedient_id')->nullable()->constrained()
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
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropForeign(['expedient_id']);
        });
        Schema::dropIfExists('borrows');
    }
};
