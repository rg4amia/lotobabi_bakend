<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->json('pions')->nullable();
            $table->string('typejeu')->nullable();
            $table->string('typejeu2')->nullable();
            $table->boolean('doublechance')->default(false);
            $table->string('jeujour_name')->nullable();
            $table->string('jeujour_heure')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('montantmise')->nullable();
            $table->integer('gains')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
