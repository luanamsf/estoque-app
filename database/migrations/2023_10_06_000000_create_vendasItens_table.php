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
        Schema::create('vendasItens', function (Blueprint $table) {
            $table->id();
            $table->integer('venda_id');
            $table->string('produto_id');
            $table->string('valorVenda');
            $table->string('quantidade');
            $table->string('valorTotalItem');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendasItens');
    }
};
