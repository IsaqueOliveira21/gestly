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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            $table->decimal('total', 10, 2);
            $table->date('data_venda');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
