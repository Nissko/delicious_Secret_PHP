<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('person');
            $table->string('time');
            $table->integer('calories');
            $table->string('img', 300);
            $table->enum('status', ['На проверке', 'Опубликован'])->default('На проверке');
            $table->foreignId('country_id')->constrained('countries')->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('Users')->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};
