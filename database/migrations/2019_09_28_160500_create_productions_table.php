<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->bigInteger('recipe_id')->unsigned();
            $table->json('recipe_data');
            $table->json('production_data')->nullable();
            $table->integer('pieces_weight')->nullable();
            $table->integer('pieces_number')->nullable();
            $table->integer('total_weight')->nullable();
            $table->double('proportion', 5, 2)->nullable();
            $table->integer('pieces_final')->nullable();
            $table->integer('status')->unsigned()->default(1); // 1->pending, 2->fermenting, 3->finished
            $table->timestamps();
            $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productions');
    }
}
