<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('homeid');
            $table->unsignedBigInteger('awayid');
            $table->unsignedBigInteger('winnerid');
            $table->unsignedBigInteger('leagueid');
            $table->text('score');
            $table->unsignedBigInteger('activityid');
            $table->date('game_date');
            $table->timestamps();

            $table->foreign('homeid')->references('id')->on('teams');
            $table->foreign('awayid')->references('id')->on('teams');
            $table->foreign('winnerid')->references('id')->on('teams');
            $table->foreign('leagueid')->references('id')->on('leagues');
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
        Schema::dropIfExists('games');
    }
}
