<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabela2022 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_2022', function (Blueprint $table) {
            $table->id();
            $table->string('time', 50);
            $table->integer('ponto')->default(0);
            $table->integer('jogo')->default(0);
            $table->integer('vitoria')->default(0);
            $table->integer('empate')->default(0);
            $table->integer('derrota')->default(0);
            $table->integer('gols_pro')->default(0);
            $table->integer('gols_contra')->default(0);
            $table->integer('saldo_gols')->default(0);
            $table->string('escudo');
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
        Schema::dropIfExists('tabela_2022');
    }
}
