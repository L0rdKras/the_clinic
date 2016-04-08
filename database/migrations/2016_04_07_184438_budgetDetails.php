<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BudgetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgetDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('budget_id')->unsigned();
            $table->integer('atention_id')->unsigned();
            $table->timestamps();

            $table->foreign('budget_id')->references('id')->on('budgets');
            $table->foreign('atention_id')->references('id')->on('atentions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('budgetDetails');
    }
}
