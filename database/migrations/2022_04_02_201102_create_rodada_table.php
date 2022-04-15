<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodada', function (Blueprint $table) {
            $table->id();
            $table->integer('rodada');
            $table->unsignedBigInteger('id_time_casa');
            $table->integer('placar_time_casa')->nullable();
            $table->unsignedBigInteger('id_time_fora');
            $table->integer('placar_time_fora')->nullable();
            $table->dateTime('data_jogo')->nullable();
            $table->string('estadio')->nullable();
            $table->timestamps();
            $table->foreign('id_time_casa')->references('id')->on('tabela_2022');
            $table->foreign('id_time_fora')->references('id')->on('tabela_2022');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('rodada');
        Schema::enableForeignKeyConstraints();
    }
}
