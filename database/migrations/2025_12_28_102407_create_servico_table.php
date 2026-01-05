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
            $table->bigInteger('id')->primary();
            $table->string('nome');
            $table->string('descricao');
            $table->string('imagem')->nullable();
            $table->double('tempo_medio_duracao');
            $table->double('preco');
            $table->foreignId('categoria_servico_id')->index();
            $table->foreignId('estabelecimento_id')->index();
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
