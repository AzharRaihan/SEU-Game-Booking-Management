<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('game_name')->nullable();
            $table->string('member')->nullable();
            $table->string('board_bg_color')->nullable();
            $table->string('board_color')->nullable();
            $table->string('booked_person')->nullable();
            $table->string('status')->nullable()->default(1);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('game_avater')->nullable();
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
        Schema::dropIfExists('games');
    }
}
