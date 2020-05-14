<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->double('recipe_flours', 8, 2)->nullable();
            $table->double('recipe_liquids', 8, 2)->nullable();
            $table->double('recipe_others', 8, 2)->nullable();
            $table->double('recipe_sourdoughs', 8, 2)->nullable();
            $table->double('recipe_total', 8, 2)->nullable();
            $table->double('total_flours', 8, 2)->nullable();
            $table->double('total_liquids', 8, 2)->nullable();
            $table->double('total_others', 8, 2)->nullable();
            $table->double('total_total', 8, 2)->nullable();
            $table->double('recipe_humidity', 8, 2)->nullable();
            $table->double('total_humidity', 8, 2)->nullable();
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
}
