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
        Schema::create('estabelecimento', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->foreignId('user_id')->index()->nullable();
            $table->string('nome');
            $table->string('imagem',255)->nullable();
            $table->string('logradouro');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('telefone');
            $table->string('email');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->double('avaliacao_media')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estabelecimento');
    }
};
