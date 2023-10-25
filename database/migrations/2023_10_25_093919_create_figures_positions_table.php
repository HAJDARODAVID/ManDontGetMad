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
        Schema::create('figures_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('figure_id');
            $table->bigInteger('figure_sub_id');
            $table->unsignedBigInteger('field_id');

            $table->foreign('game_id')->references('id')->on('game_room');
            $table->foreign('figure_id')->references('id')->on('figures');
            $table->foreign('field_id')->references('id')->on('fields');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('figures_positions');
    }
};
