<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccumulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accumulations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('annual_increase_savings_yr_1_5', 20, 2);
            $table->decimal('annual_increase_savings_yr_6_10', 20, 2);
            $table->decimal('annual_increase_savings_yr_11_up', 20, 2);
            $table->integer('annual_return_investment_yr_1_5');
            $table->integer('annual_return_investment_yr_6_10');
            $table->integer('annual_return_investment_yr_11_up');
            $table->integer('years_to_accumulate_fund');
            $table->decimal('starting_amount_monthly', 20, 2);
            $table->decimal('start_up_fund', 20, 2);
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
        Schema::dropIfExists('accumulations');
    }
}
