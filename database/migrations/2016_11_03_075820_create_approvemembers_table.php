<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovemembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvemembers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_id');
            $table->string('approve_id');
            $table->string('sponsor_id');
            $table->string('child_count'); 
            $table->string('username');
            $table->string('father_name');
            $table->string('password');
            $table->string('nrc_no');
            $table->string('phone');
            $table->string('address');
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
        Schema::drop('approvemembers');
    }
}
