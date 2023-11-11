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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('produto');
            $table->string('codigo');
            $table->string('tipo');
            $table->unsignedBigInteger('fornecedor_id');
            $table->string('unidade');
            $table->string('valorCusto');
            $table->string('valorVenda');
            $table->string('quantidade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
