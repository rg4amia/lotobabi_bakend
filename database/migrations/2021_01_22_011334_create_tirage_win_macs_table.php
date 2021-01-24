<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTirageWinMacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tirage_win_macs', function (Blueprint $table) {
            $table->increments('id');
            $table->json('tirage_win')->nullable();
            $table->json('tirage_mac')->nullable();
            $table->string('mode')->nullable();
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
        Schema::dropIfExists('tirage_win_macs');
    }
}
