<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsSourdoughsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients_sourdoughs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('recipe_id')->nullable();
            $table->string('title', 255);
            $table->timestamps();
            $table->double('weight', 8, 2);
            $table->double('humidity', 8, 2);
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients_sourdoughs');
    }
}
