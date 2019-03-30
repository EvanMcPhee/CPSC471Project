<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->string('provice_state');
            $table->string('name');
            $table->text('description');
            $table->string('admin_username');
            $table->unsignedBigInteger('activityid');
            $table->timestamps();


            $table->foreign('admin_username')->references('username')->on('users');
            $table->foreign('activityid')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
}
