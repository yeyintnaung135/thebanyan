<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalincomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totalincomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_bill');
            $table->string('member_fee');
            $table->string('total_income');
            $table->string('monthly');
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
        Schema::drop('totalincomes');
    }
}
