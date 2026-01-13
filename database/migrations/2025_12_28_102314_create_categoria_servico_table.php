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
        Schema::create('categoria_servico', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('nome');
            $table->string('descricao');
            $table->string('imagem')->nullable();
            $table->string('cor_profundo',9)->nullable();
            $table->string('cor_pastel',9)->nullable();
            $table->string('cor_vivido',9)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_servico');
    }
};
