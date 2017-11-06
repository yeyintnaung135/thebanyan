<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberfeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberfees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_id');
            $table->string('fee');
            $table->string('status');
            $table->string('approved_by');
            $table->string('approved_date');
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
        Schema::drop('memberfees');
    }
}
