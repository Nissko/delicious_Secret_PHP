<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recipe_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('Recipes')->cascadeOnUpdate();
            $table->foreignId('program_id')->constrained('Programs')->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_program');
    }
};
