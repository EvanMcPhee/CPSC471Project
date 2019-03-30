<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBelongsTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belongs_tos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teamid');
            $table->string('username');
            $table->timestamps();

            $table->foreign('teamid')->references('id')->on('teams');
            $table->foreign('username')->references('username')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('belongs_tos');
    }
}
