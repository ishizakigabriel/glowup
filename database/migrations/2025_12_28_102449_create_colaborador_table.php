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
        Schema::create('colaborador', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->string('nome');
            $table->text('biografia')->nullable();
            $table->string('foto')->nullable();
            $table->bigInteger('estabelecimento_id')->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimento')->onDelete('cascade');
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
        Schema::dropIfExists('colaborador');
    }
};
