<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('current_tuition', 20, 2);
            $table->integer('current_child_age');
            $table->integer('age_to_enter_college');
            $table->integer('years_in_college');
            $table->decimal('assumed_annual_increase_tuition_fee', 20,2);
            $table->decimal('future_annual_increase_tuition_fee', 20,2);
            $table->longtext('payment')->nullable();
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
        Schema::dropIfExists('educations');
    }
}
