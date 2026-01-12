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
        Schema::create('agendamento', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('estabelecimento_id')->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimento')->onDelete('cascade');
            $table->bigInteger('servico_id')->unsigned();
            $table->foreign('servico_id')->references('id')->on('servico')->onDelete('cascade');
            $table->date('data');
            $table->time('inicio');
            $table->time('fim');
            $table->integer('status')->default(0);
            /**
             * 0 - Pendente
             * 1 - Aprovado
             * 2 - Cancelado
             */
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamento');
    }
};
