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
        Schema::create('cnae_estabelecimento', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->bigInteger('cnae_id')->unsigned();
            $table->foreign('cnae_id')->references('id')->on('cnae')->onDelete('cascade');
            $table->bigInteger('estabelecimento_id')->unsigned();
            $table->foreign('estabelecimento_id')->references('id')->on('estabelecimento')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cnae_estabelecimento');
    }
};
