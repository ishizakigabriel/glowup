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
        Schema::table('agendamento', function (Blueprint $table) {
            //
            $table->bigInteger('colaborador_id')->unsigned()->nullable();
            $table->foreign('colaborador_id')->references('id')->on('colaborador')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendamento', function (Blueprint $table) {
            //
        });
    }
};
