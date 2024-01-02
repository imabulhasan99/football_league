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
        Schema::disableForeignKeyConstraints();

        Schema::create('pointstable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')->constrained('leagues');
            $table->foreignId('team_id')->constrained('teams');
            $table->string('season');
            $table->bigInteger('position');
            $table->bigInteger('previous_position')->nullable();
            $table->bigInteger('points');
            $table->bigInteger('win');
            $table->bigInteger('lose');
            $table->bigInteger('draw');
            $table->bigInteger('goal_forward');
            $table->bigInteger('goal_conceded');
            $table->bigInteger('goal_difference');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pointstable');
    }
};
