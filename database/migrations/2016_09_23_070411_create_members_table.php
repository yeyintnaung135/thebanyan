<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sponsor_id');
            $table->string('child_count'); 
            $table->string('username');
            $table->string('father_name');
            $table->string('password');
            $table->string('bank_branch');
            $table->string('nrc_no');
            $table->string('phone');
            $table->string('address');
            $table->string('status');  
            $table->string('balance');
            $table->string('date');
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
        Schema::drop('members');
    }
}
