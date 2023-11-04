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
        Schema::create('venda_items', function (Blueprint $table) {
            $table->id();
            $table->integer('venda_id');
            $table->integer('produto_id');
            $table->string('valorVenda');
            $table->integer('quantidade');
            $table->string('valorTotalItem');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    //TODO: INSERIR AS FOREIGN KEY

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_items');
    }
};
