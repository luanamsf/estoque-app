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
        Schema::create('entrada_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entrada_id');
            $table->unsignedBigInteger('produto_id');
            $table->string('valorEntrada');
            $table->integer('quantidade');
            $table->string('valorTotalItem');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('entrada_id')->references('id')->on('entradas');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_items');
    }
};
