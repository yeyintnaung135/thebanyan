<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlybonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthlybonus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_id');
            $table->string('totalbonus');
            $table->string('monthly');
            $table->string('payroll_by');
            $table->string('payroll_date');
            $table->string('status');
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
        Schema::drop('monthlybonus');
    }
}
