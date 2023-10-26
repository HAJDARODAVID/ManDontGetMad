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
        Schema::table('figures_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('figure_sub_id')->change();

            $table->foreign('figure_sub_id')->references('id')->on('figure_symbol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
