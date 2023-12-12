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
            $table->integer('tipo_id');
            $table->integer('fornecedor_id');
            $table->integer('unidade_id');
            $table->string('valorCusto');
            $table->string('valorVenda');
            $table->string('quantidade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');
            $table->foreign('tipo_id')->references('id')->on('tipo_produtos');
            $table->foreign('unidade_id')->references('id')->on('unidade_produtos');
        });
    }   

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
