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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj');
            $table->string('razaoSocial');
            $table->string('fantasia');
            $table->string('InscEstadual');
            $table->string('telefone');
            $table->string('email');
            $table->string('website');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('cep');
            $table->string('tipo');
            $table->string('segmento');
            $table->string('nomeResponsavel');
            $table->string('telefoneResponsavel');
            $table->string('emailResponsavel');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};