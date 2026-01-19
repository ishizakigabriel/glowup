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
        Schema::create('cnae_categoria', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('cnae_id')->unsigned();
            $table->foreign('cnae_id')->references('id')->on('cnae')->onDelete('cascade');
            $table->bigInteger('categoria_servico_id')->unsigned();
            $table->foreign('categoria_servico_id')->references('id')->on('categoria_servico')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cnae_categoria');
    }
};
