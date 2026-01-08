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
        Schema::create('servico', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('nome');
            $table->string('descricao');
            $table->string('imagem')->nullable();
            $table->double('tempo_medio_duracao');
            $table->double('preco');
            $table->bigInteger('categoria_servico_id')->unsigned();
            $table->foreign('categoria_servico_id')->references('id')->on('categoria_servico')->onDelete('cascade');
            $table->bigInteger('estabelecimento_id')->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimento')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servico');
    }
};
