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

        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixtures_id')->constrained('fixtures');
            $table->bigInteger('home_team_goals')->nullable();
            $table->bigInteger('away_team_goals')->nullable();
            $table->string('home_team_scorers')->nullable();
            $table->string('away_team_scorers')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
