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
        Schema::create('figures_start_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('figure_id');
            $table->integer('postFix');
            $table->bigInteger('top');
            $table->bigInteger('left');

            $table->foreign('figure_id')->references('id')->on('figures');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('figures_start_positions');
    }
};
