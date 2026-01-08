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
        Schema::create('colaborador_servico', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('colaborador_id')->unsigned();
            $table->foreign('colaborador_id')->references('id')->on('colaborador')->onDelete('cascade');
            $table->bigInteger('servico_id')->unsigned();
            $table->foreign('servico_id')->references('id')->on('servico')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaborador_servico');
    }
};
