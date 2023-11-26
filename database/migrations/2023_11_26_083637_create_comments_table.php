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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('texto');
            $table->date('fecha');
            $table->foreignId('user_id')->nullable()->constrained()
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['expedient_id']);
        });
        Schema::dropIfExists('comments');
    }
};
