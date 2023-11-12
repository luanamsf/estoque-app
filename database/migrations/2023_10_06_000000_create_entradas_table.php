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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('user_id');
            $table->string('notaFiscal');
            $table->string('serieNF');
            $table->string('valorTotalEntrada');
            $table->string('dataEntrada');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
